
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Records | Sunrise Public School</title>

    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0B2A4A;
            --navy-dark: #071b33;
            --blue: #0b5ed7;
            --blue-soft: #e8f0ff;
            --bg: #f3f6fc;
            --text: #1e293b;
            --muted: #64748b;
            --line: #e8edf5;
            --header-h: 88px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        /* HEADER */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-h);
            padding: 0 28px;
            background: #fff;
            border-bottom: 1px solid var(--line);
            box-shadow: 0 2px 14px rgba(15, 23, 42, .05);
            z-index: 200;
        }

        .topbar::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            height: 3px;
            background: linear-gradient(90deg, #0b5ed7, #4facfe, #f9b233);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .topbar .logo {
            height: 60px;
            width: 60px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-name {
            font-size: 26px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.1;
        }

        .school-tag {
            font-size: 14px;
            color: var(--muted);
            letter-spacing: .5px;
            margin-top: 4px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .icon-btn {
            position: relative;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border: 0;
            border-radius: 13px;
            background: var(--bg);
            color: var(--navy);
            font-size: 19px;
        }

        .icon-btn:hover {
            background: var(--blue-soft);
            color: var(--blue);
        }

        .dot {
            position: absolute;
            top: 8px;
            right: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #fff;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            background: transparent;
            border: 0;
            padding: 4px;
            min-width: 0;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--blue), #4facfe);
            color: white;
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(11, 94, 215, .3);
        }

        .welcome-small {
            color: var(--muted);
            font-size: 12px;
            text-align: left;
        }

        .user-name {
            color: var(--navy);
            font-weight: 700;
            font-size: 16px;
            white-space: nowrap;
        }

        .dropdown-menu {
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .12);
            padding: 8px;
        }

        /* MAIN CONTENT - NO SIDEBAR OFFSET */
        .content {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            padding: calc(var(--header-h) + 20px) 20px 30px;
        }

        .page {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        /* STUDENT RECORDS CARD */
        .table-card {
            width: 100%;
            max-width: 100%;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .07);
        }

        .table-card .card-header {
            background: #fff;
            padding: 20px 24px;
            border-bottom: 1px solid var(--line);
        }

        .heading-title {
            font-size: 23px;
            font-weight: 800;
            margin: 0;
            color: #172033;
        }

        .count-text {
            font-size: 14px;
            color: var(--muted);
            margin-top: 3px;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
        }

        .search-box input {
            min-width: 250px;
            padding-left: 38px;
        }

        .toolbar .form-control,
        .toolbar .form-select {
            min-height: 44px;
            border-radius: 12px;
            border: 1px solid #dbe3ef;
            font-size: 14px;
        }

        .toolbar .form-control:focus,
        .toolbar .form-select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(11, 94, 215, .12);
        }

        .btn-soft {
            min-height: 44px;
            background: var(--bg);
            border: 1px solid #dbe3ef;
            color: var(--navy);
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-soft:hover {
            background: var(--blue-soft);
            color: var(--blue);
        }

        .btn-add {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, var(--blue), #3d8bff);
            border: none;
            color: #fff;
            border-radius: 12px;
            padding: 9px 18px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-add:hover {
            color: #fff;
            box-shadow: 0 6px 16px rgba(11, 94, 215, .25);
        }

        /* TABLE */
        .table-wrap {
            width: 100%;
            max-height: 65vh;
            overflow: auto;
        }

        .table {
            margin: 0;
            font-size: 14px;
            white-space: nowrap;
        }

        .table thead th {
            position: sticky;
            top: 0;
            z-index: 3;
            background: #f1f5fb;
            color: #475569;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 700;
            padding: 15px;
            border-bottom: 1px solid #e1e8f3;
        }

        .table td {
            vertical-align: middle;
            padding: 15px;
            border-color: #f0f3f8;
            background: #fff;
        }

        .table tbody tr:hover td {
            background: #f6f9ff;
        }

        .student-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #172033;
        }

        .initial {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 50%;
            background: linear-gradient(135deg, #e6efff, #d4e4ff);
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .class-pill {
            display: inline-block;
            background: #eef2ff;
            color: #4338ca;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .gender-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #f1f5f9;
            color: #475569;
        }

        .fee {
            font-variant-numeric: tabular-nums;
        }

        .badge-paid,
        .badge-unpaid {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .badge-paid {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-unpaid {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-action {
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 11px;
        }

        .empty-state td,
        .no-match td {
            text-align: center;
            padding: 45px !important;
            color: var(--muted);
        }

        .no-match {
            display: none;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .table-card .card-header {
                align-items: flex-start !important;
            }

            .toolbar {
                width: 100%;
            }

            .search-box {
                flex: 1 1 220px;
            }

            .search-box input {
                width: 100%;
                min-width: 0;
            }
        }

        @media (max-width: 768px) {
            :root {
                --header-h: 76px;
            }

            .topbar {
                padding: 0 12px;
            }

            .topbar .logo {
                width: 44px;
                height: 44px;
            }

            .brand {
                gap: 8px;
            }

            .school-name {
                font-size: 16px;
            }

            .school-tag,
            .welcome-small,
            .user-name,
            .header-chevron {
                display: none;
            }

            .header-right {
                gap: 7px;
            }

            .icon-btn {
                width: 36px;
                height: 36px;
            }

            .avatar {
                width: 38px;
                height: 38px;
            }

            .content {
                padding: calc(var(--header-h) + 14px) 10px 20px;
            }

            .table-card {
                border-radius: 14px;
            }

            .table-card .card-header {
                padding: 16px;
            }

            .heading-title {
                font-size: 20px;
            }

            .toolbar > * {
                max-width: 100%;
            }

            .toolbar .form-select {
                flex: 1 1 140px;
            }
        }

        @media print {
            .topbar,
            .toolbar,
            .no-print {
                display: none !important;
            }

            .content {
                margin: 0;
                padding: 0;
            }

            .table-wrap {
                max-height: none;
                overflow: visible;
            }

            .table td:last-child,
            .table th:last-child {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="topbar d-flex justify-content-between align-items-center">
        <div class="brand">
            <img src="{{ asset('images/School logo.png') }}" class="logo" alt="School Logo">

            <div>
                <div class="school-name">Sunrise Public School</div>
                <div class="school-tag">Learn • Grow • Succeed</div>
            </div>
        </div>

        <div class="header-right">
            <button class="icon-btn" type="button" title="Calendar">
                <i class="bi bi-calendar3"></i>
            </button>

            <button class="icon-btn" type="button" title="Notifications">
                <i class="bi bi-bell"></i>
                <span class="dot"></span>
            </button>

            <div class="dropdown">
                <button class="user-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}
                    </div>

                    <div>
                        <div class="welcome-small">Welcome back</div>
                        <div class="user-name">
                            {{ Auth::user()->name ?? 'School Admin' }}
                        </div>
                    </div>

                    <i class="bi bi-chevron-down text-muted small header-chevron"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="px-3 py-2 small text-muted">
                        Signed in as<br>
                        <strong class="text-dark">{{ Auth::user()->name ?? 'School Admin' }}</strong>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="content">
        <div class="page">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card table-card">

                <!-- CARD HEADER -->
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h5 class="heading-title">
                            <i class="bi bi-table me-2 text-primary"></i>Student Records
                        </h5>

                        <div class="count-text" id="countText">
                            Showing {{ $student->count() }} of {{ $student->count() }} students
                        </div>
                    </div>

                    <div class="toolbar">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search student...">
                        </div>

                        <select id="classFilter" class="form-select" style="width:auto;">
                            <option value="">All Classes</option>
                            @foreach($student->pluck('class')->filter()->unique()->sort() as $c)
                                <option value="{{ strtolower($c) }}">{{ $c }}</option>
                            @endforeach
                        </select>

                        <select id="statusFilter" class="form-select" style="width:auto;">
                            <option value="">All Payments</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>

                        <button type="button" class="btn-soft" onclick="window.print()">
                            <i class="bi bi-printer me-1"></i> Print
                        </button>

                        <a href="{{ route('Student.create') }}" class="btn-add">
                            <i class="bi bi-person-plus"></i> Add Student
                        </a>
                    </div>
                </div>

                <!-- STUDENT TABLE -->
                <div class="card-body p-0">
                    <div class="table-responsive table-wrap">
                        <table class="table table-hover align-middle" id="studentTable">
                            <thead>
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Full Name</th>
                                    <th>Student ID</th>
                                    <th>Date of Birth</th>
                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>Class</th>
                                    <th>Guardian Phone</th>
                                    <th>Student Phone</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Admission Fees</th>
                                    <th>Tuition Fees</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($student as $item)
                                    @php
                                        $isPaid = in_array(
                                            strtolower((string) $item->paymentstatus),
                                            ['1', 'paid', 'yes', 'complete', 'completed']
                                        );
                                    @endphp

                                    <tr class="student-row"
                                        data-class="{{ strtolower($item->class ?? '') }}"
                                        data-status="{{ $isPaid ? 'paid' : 'unpaid' }}">

                                        <td class="ps-4">{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="student-cell">
                                                <span class="initial">
                                                    {{ strtoupper(substr($item->fullname ?? '?', 0, 1)) }}
                                                </span>
                                                {{ $item->fullname }}
                                            </div>
                                        </td>

                                        <td>{{ $item->studentid }}</td>
                                        <td>{{ $item->dateofbirth }}</td>
                                        <td>{{ $item->fathername }}</td>
                                        <td>{{ $item->mothername }}</td>

                                        <td>
                                            <span class="class-pill">{{ $item->class }}</span>
                                        </td>

                                        <td>{{ $item->parentphone }}</td>
                                        <td>{{ $item->studentphone }}</td>
                                        <td>{{ $item->email }}</td>

                                        <td>
                                            <span class="gender-pill">
                                                <i class="bi {{ strtolower($item->gender ?? '') == 'female' ? 'bi-gender-female' : 'bi-gender-male' }}"></i>
                                                {{ $item->gender }}
                                            </span>
                                        </td>

                                        <td>{{ $item->address }}</td>
                                        <td class="fee">₹{{ number_format((float) $item->admissionfees, 2) }}</td>
                                        <td class="fee">₹{{ number_format((float) $item->tuitionfees, 2) }}</td>
                                        <td class="fee fw-bold">₹{{ number_format((float) $item->totalfees, 2) }}</td>

                                        <td>
                                            @if($isPaid)
                                                <span class="badge-paid">
                                                    <i class="bi bi-check-circle me-1"></i>Paid
                                                </span>
                                            @else
                                                <span class="badge-unpaid">
                                                    <i class="bi bi-x-circle me-1"></i>Unpaid
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('Student.edit', ['student' => $item]) }}"
                                                   class="btn btn-action btn-outline-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('Student.destroy', ['student' => $item]) }}"
                                                      onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-action btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-state">
                                        <td colspan="17">
                                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                            Abhi koi student record nahi hai.
                                            <div class="mt-3">
                                                <a href="{{ route('Student.create') }}" class="btn-add">
                                                    <i class="bi bi-person-plus"></i> Add First Student
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                                <tr class="no-match" id="noMatch">
                                    <td colspan="17">
                                        <i class="bi bi-search fs-2 d-block mb-2"></i>
                                        Koi matching student nahi mila.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-2">
    <a href="{{ route('Student.student') }}" class="btn btn-primary px-4">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>
        </div>
    </main>
    

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const classFilter = document.getElementById('classFilter');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('#studentTable tbody tr.student-row');
            const countText = document.getElementById('countText');
            const noMatch = document.getElementById('noMatch');

            function applyFilters() {
                const searchText = searchInput.value.trim().toLowerCase();
                const selectedClass = classFilter.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();

                let visibleCount = 0;

                rows.forEach(function (row) {
                    const rowText = row.innerText.toLowerCase();
                    const studentClass = (row.dataset.class || '').toLowerCase();
                    const studentStatus = (row.dataset.status || '').toLowerCase();

                    const matchesSearch = rowText.includes(searchText);
                    const matchesClass = selectedClass === '' || studentClass === selectedClass;
                    const matchesStatus = selectedStatus === '' || studentStatus === selectedStatus;

                    const showRow = matchesSearch && matchesClass && matchesStatus;

                    row.style.display = showRow ? '' : 'none';

                    if (showRow) {
                        visibleCount++;
                    }
                });

                countText.textContent = `Showing ${visibleCount} of ${rows.length} students`;

                if (noMatch) {
                    noMatch.style.display =
                        rows.length > 0 && visibleCount === 0 ? 'table-row' : 'none';
                }
            }

            searchInput.addEventListener('input', applyFilters);
            classFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
        });
    </script>

</body>
</html>
