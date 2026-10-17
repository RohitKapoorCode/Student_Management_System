@extends('layouts.portal')

@section('title', 'My Dashboard')

@section('content')
@php
    $isPaid = $student && in_array(strtolower((string) $student->paymentstatus), ['1', 'paid']);
@endphp

@if(! $student)
    <div class="box"><div class="body pad empty">
        <i class="bi bi-person-exclamation"></i>
       Your student record has not yet been linked to this login by the school.<br>
        Please contact the school office/administration.
    </div></div>
@else

    {{-- Welcome banner --}}
    <div class="hero mb-4">
        <div class="d-flex align-items-center gap-4 flex-wrap position-relative" style="z-index:2;">
            <div class="hero-avatar">{{ strtoupper(substr($student->fullname, 0, 1)) }}</div>
            <div class="flex-grow-1">
                <div style="opacity:.9">Welcome back,</div>
                <h3>{{ $student->fullname }}</h3>
                <span class="chip"><i class="bi bi-mortarboard"></i> Class {{ $student->class }}</span>
                <span class="chip"><i class="bi bi-hash"></i> ID: {{ $student->studentid }}</span>
                <span class="chip {{ $isPaid ? 'chip-paid' : 'chip-unpaid' }}">
                    <i class="bi {{ $isPaid ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                    {{ $isPaid ? 'Fees Paid' : 'Fees Pending' }}
                </span>
                <a href="#edit" class="chip" style="text-decoration:none;color:#fff;"><i class="bi bi-pencil-square"></i> Edit My Details</a>
            </div>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="row g-4">
        <div class="col-md-6 col-xl-3"><div class="stat s1"><small>My Class</small><h2>{{ $student->class }}</h2><i class="bi bi-mortarboard-fill"></i></div></div>
        <div class="col-md-6 col-xl-3"><div class="stat s2"><small>Student ID</small><h2>{{ $student->studentid }}</h2><i class="bi bi-person-badge-fill"></i></div></div>
        <div class="col-md-6 col-xl-3"><div class="stat s3"><small>Total Fees</small><h2>₹{{ $student->totalfees }}</h2><i class="bi bi-currency-rupee"></i></div></div>
        <div class="col-md-6 col-xl-3"><div class="stat s4"><small>Payment Status</small><h2>{{ $isPaid ? 'Paid' : 'Unpaid' }}</h2><i class="bi bi-patch-check-fill"></i></div></div>
    </div>

    <div class="row g-4 mt-1">
        {{-- Personal info --}}
        <div class="col-lg-7" id="profile">
            <div class="box">
                <h5><i class="bi bi-person-vcard"></i>Personal Information</h5>
                <div class="body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-row"><div class="info-ico"><i class="bi bi-person"></i></div><div><div class="info-label">Full Name</div><div class="info-value">{{ $student->fullname }}</div></div></div>
                            <div class="info-row"><div class="info-ico"><i class="bi bi-cake2"></i></div><div><div class="info-label">Date of Birth</div><div class="info-value">{{ $student->dateofbirth }}</div></div></div>
                            <div class="info-row"><div class="info-ico"><i class="bi {{ strtolower($student->gender) == 'female' ? 'bi-gender-female' : 'bi-gender-male' }}"></i></div><div><div class="info-label">Gender</div><div class="info-value">{{ $student->gender }}</div></div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row"><div class="info-ico"><i class="bi bi-telephone"></i></div><div><div class="info-label">Student Phone</div><div class="info-value">{{ $student->studentphone }}</div></div></div>
                            <div class="info-row"><div class="info-ico"><i class="bi bi-envelope"></i></div><div><div class="info-label">Email</div><div class="info-value">{{ $student->email }}</div></div></div>
                            <div class="info-row"><div class="info-ico"><i class="bi bi-geo-alt"></i></div><div><div class="info-label">Address</div><div class="info-value">{{ $student->address }}</div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fees --}}
        <div class="col-lg-5" id="fees">
            <div class="box">
                <h5><i class="bi bi-cash-stack"></i>Fee Details</h5>
                <div class="body">
                    <div class="fee-line"><span>Admission Fees</span><span>₹{{ $student->admissionfees }}</span></div>
                    <div class="fee-line"><span>Tuition Fees</span><span>₹{{ $student->tuitionfees }}</span></div>
                    <div class="fee-total"><span>Total</span><span>₹{{ $student->totalfees }}</span></div>
                    @if($isPaid)
                        <div class="banner banner-paid"><i class="bi bi-check-circle-fill"></i> Your fee has been paid. Thank you!</div>
                    @else
                        <div class="banner banner-unpaid"><i class="bi bi-exclamation-circle-fill"></i> Your fees are still pending.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        {{-- Family --}}
        <div class="col-lg-5" id="family">
            <div class="box">
                <h5><i class="bi bi-people"></i>Family Details</h5>
                <div class="body">
                    <div class="info-row"><div class="info-ico"><i class="bi bi-person-standing"></i></div><div><div class="info-label">Father Name</div><div class="info-value">{{ $student->fathername }}</div></div></div>
                    <div class="info-row"><div class="info-ico"><i class="bi bi-person-standing-dress"></i></div><div><div class="info-label">Mother Name</div><div class="info-value">{{ $student->mothername }}</div></div></div>
                    <div class="info-row"><div class="info-ico"><i class="bi bi-telephone-inbound"></i></div><div><div class="info-label">Guardian Phone</div><div class="info-value">{{ $student->parentphone }}</div></div></div>
                </div>
            </div>
        </div>

        {{-- Results (teacher ke daale hue marks) --}}
       <div class="col-lg-7" id="results">
            <div class="box">
                <h5><i class="bi bi-file-earmark-bar-graph"></i>Exam &amp; Results</h5>
                <div class="body pad">
                    @forelse($results as $exam => $r)
                        <h6 class="fw-bold mb-2 {{ $loop->first ? '' : 'mt-4' }}">{{ $exam }}</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead><tr><th>Subject</th><th>Max</th><th>Marks</th><th>Grade</th></tr></thead>
                                <tbody>
                                    @foreach($r['rows'] as $m)
                                        <tr><td>{{ $m->subject }}</td><td>{{ $m->max_marks }}</td><td>{{ $m->marks + 0 }}</td><td>{{ $m->grade }}</td></tr>
                                    @endforeach
                                    <tr class="fw-bold"><td>Total</td><td>{{ $r['max'] }}</td><td>{{ $r['got'] + 0 }}</td><td>{{ $r['grade'] }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 d-flex flex-wrap gap-3 align-items-center">
                            <span>Percentage: <strong>{{ $r['pct'] }}%</strong></span>
                            <span class="{{ $r['pass'] ? 'badge-ok' : 'badge-bad' }}">{{ $r['pass'] ? 'Pass' : 'Fail' }}</span>
                        </div>
                    @empty
                        <div class="empty">
                            <i class="bi bi-journal-text"></i>
                            No results have been published yet..<br>When the teacher enters the marks, they will appear here.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endif

@if($student)
    @include('portal._profile-form')
@endif
@endsection
