<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $participant = \App\Participant::where([['user_id', '=', Auth::user()->id], ['status', '=', 'Ada']])->get();
        $arrCSID = [];
        foreach ($participant as $item) {
            array_push($arrCSID, $item->classroom_id);
        }

        if (Auth::user()->roles == 'Admin') {
            $classrooms = \App\Classroom::latest()->paginate(6);
        }else{
            $classrooms = \App\Classroom::whereIn('id', $arrCSID)->latest()->paginate(6);
        }

        $filterKeyword = $request->get('keyword');

        
        if ($filterKeyword) {
            if (Auth::user()->roles == 'Admin') {
                $classrooms = \App\Classroom::where('nama_kelas', 'LIKE', "%$filterKeyword%")->latest()->paginate(5);
            }else{
                $classrooms = \App\Classroom::whereIn('id', $arrCSID)->where('nama_kelas', 'LIKE',
                "%$filterKeyword%")->latest()->paginate(5);
            }
        }

        return view('back-ui.classrooms.index', ['classrooms' => $classrooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-ui.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|max:20',
            'bidang_ilmu' => 'required|max:50',
            'deskripsi' => 'max:255',
        ]);

        $classroom = new \App\Classroom;

        $classroom->user_id = Auth::user()->id;
        $classroom->nama_kelas = $request->get('nama_kelas');
        $classroom->bidang_ilmu = $request->get('bidang_ilmu');
        $classroom->deskripsi = $request->get('deskripsi');
        $classroom->token = Str::random(8);

        $classroom->save();

        $new_participant = new \App\Participant;

        $new_participant->user_id = Auth::user()->id;
        $new_participant->classroom_id = $classroom->id;

        $new_participant->save();

        return redirect()->route('classrooms.create')->with('status', 'Kelas berhasil ditambahkan');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = \App\Classroom::where('token', '=', $id)->first();

        $participant = \App\Participant::where(['classroom_id' => $classroom->id, 'status' => 'Ada'])->get();
        $theory = \App\Theory::where(['classroom_id' => $classroom->id])->get();

        return view('back-ui.classrooms.edit', ['classroom' => $classroom , 'participant' => $participant, 'theory' => $theory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if ($request->has('updateInformation')) {
            
            $request->validate([
                'nama_kelas' => 'required|max:20',
                'bidang_ilmu' => 'required|max:50',
                'deskripsi' => 'max:255',
            ]);
    
            $classroom = \App\Classroom::findOrFail($id);
    
            $classroom->nama_kelas = $request->get('nama_kelas');
            $classroom->bidang_ilmu = $request->get('bidang_ilmu');
            $classroom->deskripsi = $request->get('deskripsi');

            $classroom->save();
            return redirect()->route('classrooms.show', $classroom->token)->with('success', 'Kelas berhasil diupdate');die;
        }elseif ($request->has('keluarKelas')) {
    
            $participant = \App\Participant::where([['user_id', '=', $id],['classroom_id', '=', $request->classroom_id]])->first();
    
            $participant->status = "Keluar";

            $participant->save();
            return redirect()->route('classrooms.index')->with('keluarKelas', 'Anda berhasil keluar kelas');die;
        }elseif ($request->has('undangPeserta')) {
            $request->validate(['username' => 'required']);
            
            $user = \App\User::where('username', '=', $request->username)->first();

            if (!$user) {
                return redirect()->route('classrooms.show', $id)->with('msgParticipantE', 'Username anda yang masukan
                belum terdaftar di aplikasi ini');
            }else {
                $classroom = \App\Classroom::where('token', '=', $id)->first();
                $participant = \App\Participant::where([['user_id', '=', $user->id], ['classroom_id', '=', $classroom->id]])->first();
                if (!$participant) {

                    $new_participant = new \App\Participant;

                    $new_participant->user_id = $user->id;
                    $new_participant->classroom_id = $classroom->id;

                    $new_participant->save();
                    return redirect()->route('classrooms.show', $id)->with('msgParticipantS', 'User berhasil ditambahkan');die;
                }elseif ($participant->status == 'Ada') {
                    return redirect()->route('classrooms.show', $id)->with('msgParticipantE', 'User ini telah mengikuti kelas');die;
                }else{
                    $participant->status = "Ada";
                    $participant->save();
                    return redirect()->route('classrooms.show', $id)->with('msgParticipantS', 'User berhasil ditambahkan kembali');die;
                }
            }
        }elseif ($request->has('keluarkan')) {

            $classroom = \App\Classroom::findOrFail($request->get('classroom_id'));

            if ($classroom->user_id == $request->user_id) {
                return redirect()->route('classrooms.show', $id)->with('msgKeluarkanE', 'Pembuat kelas tidak bisa dikeluarkan, silahkan hapus kelas di halaman utama menu kelas');die;
            }

            $participant = \App\Participant::where(['user_id' => $request->get('user_id'), 'classroom_id' => $classroom->id])->first();
            $participant->status = 'Dikeluarkan';
            $participant->save();
            return redirect()->route('classrooms.show', $id)->with('msgKeluarkanS', 'User berhasil dikeluarkan !');die;
        }elseif ($request->has('ubahMateri')){
            $request->validate([
                'judul_materi_ubah' => 'required|max:50',
                'deskripsi_materi_ubah' => 'max:255',
                'file_materi_ubah' => 'file|mimes:jpeg,png,jpg,docx,doc,pdf,rar,zip|max:2048'
            ]);

            $theory = \App\Theory::where('id', '=', $request->get('theory_id'))->first();

            $theory->judul = $request->judul_materi_ubah;
            $theory->deskripsi = $request->deskripsi_materi_ubah;

            if ($request->file('file_materi_ubah')) {
                $file = $request->file('file_materi_ubah')->store('theory_files', 'public');
                $theory->file_name = $request->file('file_materi_ubah')->getClientOriginalName();
                $theory->file = $file;
            }
            $theory->save();
            return redirect()->route('classrooms.show', $id)->with('msgMateriSU', 'Materi berhasil diubah');die;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $participant = \App\Participant::where('classroom_id', '=', $id);
        $participant->delete();

        $theory = \App\Theory::where('classroom_id', '=', $id)->get();

        if (!$theory->isEmpty()) {
            foreach ($theory as $item) {
                if ($item->file && file_exists(storage_path('app/public/' . $item->file))) {
                    \Storage::delete('public/' . $item->file);    
                }
            }
            $theorys = \App\Theory::where('classroom_id', '=', $id);
            $theorys->delete();
        }

        $classroom = \App\Classroom::findOrFail($id);
        $classroom->delete();


        return redirect()->route('classrooms.index')->with('success', 'Data berhasil dihapus');
    }

    public function create_participant(Request $request){

        $request->validate(['token' => 'required']);

        $classroom = \App\Classroom::where('token', '=', $request->token)->first();

        if (!$classroom) {
            return redirect()->route('classrooms.index')->with('msgParticipantE', 'Token anda yang masukan
            belum terdaftar');die;
        }else {
            $participant = \App\Participant::where(['user_id' => Auth::user()->id, 'classroom_id' => $classroom->id])->first();
            if (!$participant) {
                $new_participant = new \App\Participant;

                $new_participant->user_id = Auth::user()->id;
                $new_participant->classroom_id = $classroom->id;

                $new_participant->save();
                return redirect()->route('classrooms.index')->with('msgParticipantS', 'Kelas berhasil ditambahkan');die;
            }elseif ($participant->status = "Keluar" || $participant->status = "Dikeluarkan") {
                return redirect()->route('classrooms.index')->with('msgParticipantE', 'Anda sudah keluar atau dikeluarkan dari kelas ini, silahkan hubungi admin kelas');die;
            }else{
                return redirect()->route('classrooms.index')->with('msgParticipantE', 'Anda sudah mengikuti kelas ini');die;
            }
        }

    }

    public function theories(Request $request, $id){

        if ($request->has('tambahMateri')) {
            $request->validate([
                'judul_materi' => 'required|max:50',
                'deskripsi_materi' => 'max:255',
                'file_materi' => 'file|mimes:jpeg,png,jpg,docx,doc,pdf,rar,zip|max:2048'
            ]);
    
            $theory = new \App\Theory;
            $theory->user_id = Auth::user()->id;
            $theory->classroom_id = $request->classroom_id;
            $theory->judul = $request->judul_materi;
            $theory->deskripsi = $request->deskripsi_materi;
            $theory->slug = Str::random(10);
    
            if ($request->file('file_materi')) {
                $file = $request->file('file_materi')->store('theory_files', 'public');
                $theory->file_name = $request->file('file_materi')->getClientOriginalName();
                $theory->file = $file;
            }
            $theory->save();
            return redirect()->route('classrooms.show', $id)->with('msgMateriS', 'Materi berhasil ditambahkan');die;
        }elseif ($request->has('lihatMateri')){
            $theory = \App\Theory::where('id', '=', $request->get('theory_id'))->first();
            echo json_encode($theory);
        }elseif ($request->has('ubahMateri')) {
            $theory = \App\Theory::where('id', '=', $request->get('theory_id'))->first();
            echo json_encode($theory);
        }elseif ($request->has('hapusMateri')) {
            $theory = \App\Theory::where('id', '=', $request->get('theory_id'))->first();

            if ($theory->file && file_exists(storage_path('app/public/' . $theory->file))) {
                \Storage::delete('public/' . $theory->file);    
            }

            $theory->delete();
            return redirect()->route('classrooms.show', $id);
        }
        
    }

}
