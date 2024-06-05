<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students.index',['students' => Student::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = DB::table('classrooms')->get();
        return view('students.create',compact('classrooms'));
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
            'StudentName' => 'required',
            'StudentEmail' => 'required|email',
        ]);
        $StudentName = $request->input('StudentName');
        $StudentEmail = $request->input('StudentEmail');
        $StudentGender = $request->input('StudentGender');
        $ClassRoomID = $request->input('ClassRoomID');
        $validatedData = $request->validate([
            'StudentName' => 'required',
            'StudentEmail' => 'required',
        ]);
        DB::table('students')->insert([
            'StudentName' => $StudentName,
            'StudentEmail' => $StudentEmail,
            'StudentGender' => $StudentGender,
            'ClassRoomID' => $ClassRoomID
        ]);
        return redirect()->route('students.index')->with('success','Student Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student,int $studentid)
    {   
        $student = Student::where('StudentID',$studentid)->first();
        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student,int $studentid)
    {
        $student = Student::where('StudentID',$studentid)->first();
        $classrooms = DB::table('classrooms')->get();
        // return view('students.edit')->with('student',$student);
        return view('students.edit',['student' => $student,'classrooms' => $classrooms]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $studentid)
    {
        $request->validate([
            'StudentName' => 'required',
            'StudentEmail' => 'required|email',
        ]);
        $StudentName = $request->input('StudentName');
        $StudentEmail = $request->input('StudentEmail');
        $StudentGender = $request->input('StudentGender');
        $ClassRoomID = $request->input('ClassRoomID');
        $validatedData = $request->validate([
            'StudentName' => 'required',
            'StudentEmail' => 'required',
        ]);
        $student = Student::where('StudentID',$studentid)->update([
            'StudentName' => $StudentName,
            'StudentEmail' => $StudentEmail,
            'StudentGender' => $StudentGender,
            'ClassRoomID' => $ClassRoomID
        ]);
        return redirect()->route('students.index')->with('success','Student Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $StudentID)
    {
        $student = Student::where('StudentID',$StudentID)->first()->delete();
        return redirect()->route('students.index')->with('success','Student deleted Successfully');

    }
}
