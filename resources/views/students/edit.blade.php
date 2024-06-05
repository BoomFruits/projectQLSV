@extends('students.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            Sửa sinh viên
        </div>
        <div class="card-body">
            <form action="{{ route('students.update',$student->StudentID) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="StudentID" value="{{ $student->StudentID }}">
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Tên sinh viên</label>
                    <div class="col-sm-10">
                        <input type="text" name="StudentName" id="" class="form-control" value="{{ $student->StudentName }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Địa chỉ Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="StudentEmail" id="" class="form-control" value="{{ $student->StudentEmail }}">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="" class="col-sm-2 col-form-label">Giới tính</label>
                    <div class="col-sm-10">
                        <select name="StudentGender" id="" class="form-control">
                            <option value="0" @if ($student->StudentGender == 0)
                                {{ 'selected' }}
                                @endif>Nam</option>
                            <option value="1"  @if($student->StudentGender == 1)
                                    {{ 'selected' }}
                                @endif>Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ClassRoomID" class="form-check-label">Chọn lớp</label>
                    <select name="ClassRoomID" id="ClassRoomID" class="form-select" required>
                        @foreach ($classrooms as $classroom)
                            <option  @if($classroom->ClassRoomID == $student->ClassRoomID) {{  'selected' }} @endif value="{{ $classroom->ClassRoomID }}">{{ $classroom->ClassRoomName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
                    <input type="submit" value="Sửa" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection