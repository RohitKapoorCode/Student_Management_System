@php
    $dob = $student->dateofbirth ? \Carbon\Carbon::parse($student->dateofbirth)->format('Y-m-d') : '';
@endphp

<div class="row g-4 mt-1" id="edit">
    <div class="col-12">
        <div class="box">
            <h5><i class="bi bi-pencil-square"></i>Edit My Details</h5>
            <div class="body pad">
                <form method="POST" action="{{ route('student.profile.save') }}">
                    @csrf
                    <div class="row g-3">

                        {{-- Naam student badal sakta hai; class aur student ID sirf school --}}
                        <div class="col-md-4">
                            <label class="form-label" for="fullname">Full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required
                                   value="{{ old('fullname', $student->fullname) }}">
                            @error('fullname')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Class</label>
                            <input type="text" class="form-control" value="{{ $student->class }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Student ID</label>
                            <input type="text" class="form-control" value="{{ $student->studentid }}" disabled>
                        </div>

                        {{-- Student khud badal sakta hai --}}
                        <div class="col-md-4">
                            <label class="form-label" for="dateofbirth">Date of birth</label>
                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" required
                                   value="{{ old('dateofbirth', $dob) }}">
                            @error('dateofbirth')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                @foreach(['Male', 'Female', 'Other'] as $g)
                                    <option value="{{ $g }}" @selected(old('gender', $student->gender) == $g)>{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('gender')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="email">Email (login)</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   value="{{ old('email', Auth::user()->email) }}">
                            @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="fathername">Father's name</label>
                            <input type="text" class="form-control" id="fathername" name="fathername" required
                                   value="{{ old('fathername', $student->fathername) }}">
                            @error('fathername')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mothername">Mother's name</label>
                            <input type="text" class="form-control" id="mothername" name="mothername" required
                                   value="{{ old('mothername', $student->mothername) }}">
                            @error('mothername')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="studentphone">Student phone</label>
                            <input type="tel" class="form-control" id="studentphone" name="studentphone" required
                                   value="{{ old('studentphone', $student->studentphone) }}">
                            @error('studentphone')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="parentphone">Guardian phone</label>
                            <input type="tel" class="form-control" id="parentphone" name="parentphone" required
                                   value="{{ old('parentphone', $student->parentphone) }}">
                            @error('parentphone')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', $student->address) }}</textarea>
                            @error('address')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-main mt-4"><i class="bi bi-check2-circle me-1"></i> Submit Details</button>
                    <div class="text-muted small mt-2">Only the school can change the class, student ID, fees, and marks. If the email address is changed, you will need to log in using the new email address next time.</div>
                </form>
            </div>
        </div>
    </div>
</div>
