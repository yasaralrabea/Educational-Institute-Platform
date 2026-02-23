<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إدارة الحركات المالية</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#f3f6fb;
      --card:#ffffff;
      --text:#0f172a;
      --muted:#64748b;
      --border:#e5e7eb;

      --primary:#253b5c;
      --primary-dark:#1f2f48;
      --primary-2:#2563eb;
      --accent:#ffec1d;

      --success:#10b981;
      --danger:#ef4444;
      --warning:#f59e0b;

      --shadow: 0 12px 34px rgba(15,23,42,.10);
      --shadow-sm: 0 6px 18px rgba(15,23,42,.08);
      --radius: 20px;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    body{
      font-family:"Cairo",sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.65;
      min-height:100vh;
    }
    a{color:inherit;text-decoration:none;}
    button{font-family:inherit;}
    .container{ width:min(1200px, calc(100% - 32px)); margin-inline:auto; }

    .background{
      position:fixed;
      inset:0;
      background:
        radial-gradient(1200px 420px at 12% 0%, rgba(37,99,235,.14), transparent 55%),
        radial-gradient(900px 360px at 92% 10%, rgba(255,236,29,.16), transparent 62%),
        radial-gradient(800px 320px at 40% 100%, rgba(37,99,235,.08), transparent 55%),
        #f8fafc;
      z-index:-2;
    }

    header{
      position: sticky;
      top: 0;
      z-index: 900;
      background: linear-gradient(90deg, var(--primary), var(--primary-dark));
      color:#fff;
      box-shadow: 0 8px 30px rgba(0,0,0,.15);
    }
    .header-inner{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:16px;
      padding: 14px 0;
      min-height: 68px;
    }
    .header-title{
      display:flex;
      align-items:center;
      gap:10px;
      font-weight:900;
      font-size:22px;
      text-align:center;
      margin:0 auto;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
      max-width: 70vw;
    }
    .badge{
      font-size: 12px;
      font-weight: 900;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color: rgba(255,255,255,.92);
      white-space:nowrap;
    }
    .header-actions{
      display:flex;
      gap:10px;
      align-items:center;
      flex-shrink:0;
    }
    .icon-btn{
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color:#fff;
      cursor:pointer;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:42px;
      height:42px;
      border-radius:14px;
      transition:.22s;
      outline:none;
    }
    .icon-btn:hover{ background: rgba(255,255,255,.24); transform: translateY(-1px); }
    .icon-btn:focus-visible{ box-shadow: 0 0 0 3px rgba(37,99,235,.45); }
    .icon-btn svg{ width:22px;height:22px; }

    .menu-btn{
      position: fixed;
      top: 18px;
      right: 18px;
      z-index: 1100;
      width:46px;
      height:46px;
      border:none;
      border-radius: 16px;
      cursor:pointer;
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color:#fff;
      box-shadow: 0 12px 26px rgba(0,0,0,.22);
      backdrop-filter: blur(10px);
      transition: .22s;
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .menu-btn:hover{ background: rgba(255,255,255,.24); transform: translateY(-1px); }
    .menu-btn svg{ width:26px; height:26px; }

    .overlay{
      position: fixed;
      inset:0;
      background: rgba(0,0,0,.45);
      z-index: 1000;
      display:none;
    }
    .overlay.open{ display:block; }

    .sidebar{
      position: fixed;
      top: 0;
      right: -340px;
      width: 310px;
      max-width: calc(100% - 48px);
      height: 100%;
      background: linear-gradient(180deg, var(--primary), var(--primary-dark));
      color:#fff;
      padding: 18px;
      box-shadow: -14px 0 34px rgba(0,0,0,.35);
      transition: right .32s ease;
      z-index: 1101;
      border-radius: 22px 0 0 22px;
      overflow:auto;
    }
    .sidebar.open{ right: 0; }

    .sidebar-header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid rgba(255,255,255,.14);
    }
    .sidebar-title{
      font-size:18px;
      font-weight:900;
    }
    .close-sidebar{
      width:42px;height:42px;
      border-radius:14px;
      border: 1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.10);
      color:#fff;
      cursor:pointer;
      transition:.2s;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:22px;
      line-height:1;
    }
    .close-sidebar:hover{ background: rgba(255,255,255,.20); }

    .sidebar a{
      display:flex;
      align-items:center;
      gap:12px;
      padding: 12px 12px;
      border-radius: 16px;
      text-decoration:none;
      color:#fff;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.10);
      margin-bottom: 10px;
      transition:.22s;
    }
    .sidebar a:hover{
      background: rgba(255,236,29,.92);
      color:#111827;
      transform: translateX(-2px);
    }
    .sidebar a svg{ width:22px; height:22px; }
    .sidebar a.active{
      background: rgba(255,255,255,.18);
      border-color: rgba(255,255,255,.24);
    }

    main{ padding: 18px 0 60px; }

    .hero{
      margin-top: 18px;
      border-radius: var(--radius);
      padding: 18px;
      background: linear-gradient(135deg, rgba(37,99,235,.18), rgba(255,236,29,.14));
      border: 1px solid rgba(255,255,255,.30);
      box-shadow: 0 18px 40px rgba(0,0,0,.10);
      backdrop-filter: blur(10px);
    }
    .hero-top{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
    }
    .hero-title{
      color:#fff;
      font-weight: 900;
      font-size: 20px;
      display:flex;
      align-items:center;
      gap:10px;
    }
    .hero-sub{
      color: rgba(255,255,255,.88);
      font-size: 14px;
      margin-top: 6px;
      max-width: 70ch;
    }
    .hero-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      justify-content:flex-end;
      flex: 1 1 auto;
    }

    .stats{
      margin-top: 14px;
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
    }
    .stat{
      background: rgba(255,255,255,.92);
      border: 1px solid rgba(255,255,255,.82);
      border-radius: 18px;
      box-shadow: var(--shadow-sm);
      padding: 14px;
      display:flex;
      flex-direction:column;
      gap:6px;
      min-height: 92px;
    }
    .stat .label{ color: var(--muted); font-weight: 800; font-size: 13px; }
    .stat .value{ color: var(--primary); font-weight: 900; font-size: 18px; letter-spacing:.2px; }

    .card{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 16px;
    }

    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      padding: 11px 16px;
      border-radius: 14px;
      border: 1px solid transparent;
      cursor:pointer;
      font-weight: 900;
      font-size: 14px;
      transition:.2s;
      text-decoration:none;
      white-space:nowrap;
      user-select:none;
    }
    .btn-primary{ background: var(--primary-2); color:#fff; }
    .btn-primary:hover{ filter: brightness(.96); transform: translateY(-1px); }
    .btn-muted{ background: #6b7280; color:#fff; }
    .btn-muted:hover{ filter: brightness(.96); transform: translateY(-1px); }
    .btn-outline{
      background:#fff;
      border-color: var(--border);
      color: var(--text);
    }
    .btn-outline:hover{ background:#f9fafb; transform: translateY(-1px); }
    .btn-danger{ background: var(--danger); color:#fff; }
    .btn-danger:hover{ filter: brightness(.96); transform: translateY(-1px); }

    .form-control{
      width:100%;
      padding: 11px 12px;
      border-radius: 14px;
      border: 1px solid var(--border);
      font-size: 14px;
      background:#fff;
      outline:none;
      transition:.2s;
    }
    .form-control:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 3px rgba(37,99,235,.18);
    }

    .filter-bar{
      margin-top: 14px;
      display:flex;
      gap:12px;
      align-items:end;
      flex-wrap:wrap;
    }
    .field{
      display:flex;
      flex-direction:column;
      gap:6px;
      min-width: 170px;
    }
    label{ font-weight: 900; color:#334155; font-size: 13px; }
    .actions-inline{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
    }

    .table-wrap{ overflow:auto; margin-top: 14px; }
    table{
      width:100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      min-width: 980px;
    }
    thead th{
      position: sticky;
      top: 0;
      z-index: 2;
      background: #f1f5f9;
      color: var(--primary);
      font-weight: 900;
      padding: 12px 14px;
      font-size: 13px;
      text-align:center;
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }
    tbody td{
      background:#fff;
      padding: 12px 14px;
      text-align:center;
      border-radius: 14px;
      border: 1px solid var(--border);
      box-shadow: 0 2px 12px rgba(0,0,0,.04);
      font-size: 14px;
      vertical-align: middle;
    }
    tbody tr:hover td{ background:#fbfdff; }

    .type-pill{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      padding: 6px 10px;
      border-radius: 999px;
      font-weight: 900;
      font-size: 12px;
      border: 1px solid var(--border);
      background: #f8fafc;
      color: #334155;
      white-space:nowrap;
    }
    .type-pill.income{ background: rgba(16,185,129,.12); border-color: rgba(16,185,129,.25); color: #065f46; }
    .type-pill.expense{ background: rgba(239,68,68,.12); border-color: rgba(239,68,68,.25); color: #7f1d1d; }

    .row-actions{
      display:flex;
      gap:8px;
      justify-content:center;
      flex-wrap: wrap;
    }

    .modal{
      display:none;
      position:fixed;
      inset:0;
      background: rgba(0,0,0,.55);
      z-index: 1300;
      padding: 18px;
      align-items:center;
      justify-content:center;
    }
    .modal.open{ display:flex; }
    .modal-content{
      width: min(520px, 100%);
      max-height: 88vh;
      overflow:auto;
      background:#fff;
      border-radius: 22px;
      border: 1px solid var(--border);
      box-shadow: 0 24px 60px rgba(0,0,0,.30);
      padding: 18px;
      animation: pop .18s ease;
      display:flex;
      flex-direction:column;
      gap: 12px;
    }
    .modal-head{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eef2f7;
    }
    .modal-title{
      font-weight: 900;
      color: var(--primary);
      font-size: 18px;
    }
    .x-btn{
      width:42px;height:42px;border-radius:14px;
      border:1px solid var(--border);
      background:#f9fafb;
      cursor:pointer;
      font-size:20px;
      line-height:1;
      transition:.2s;
    }
    .x-btn:hover{ background:#eef2f7; }

    .stack{ display:flex; flex-direction:column; gap: 12px; }
    .modal-actions{ display:flex; gap:10px; flex-wrap:wrap; }

    @keyframes pop{
      from{ opacity:0; transform: translateY(10px) scale(.985); }
      to{ opacity:1; transform: translateY(0) scale(1); }
    }

    @media (max-width: 1024px){
      .stats{ grid-template-columns: 1fr; }
    }

    @media (max-width: 820px){
      .header-title{ font-size: 20px; }
      .menu-btn{ top: 14px; right: 14px; }
      .container{ width: calc(100% - 24px); }
      table{ min-width: 860px; }
    }

    @media (max-width: 640px){
      .header-title{ margin:0; max-width: 64vw; }
      .hero-actions{ justify-content:flex-start; }
      .table-wrap{ overflow: visible; }
      table{ min-width: unset; border-spacing: 0; }
      thead{ display:none; }

      tbody, tr, td{ display:block; width:100%; }
      tbody tr{
        background:#fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 10px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 12px;
      }
      tbody td{
        border:none;
        box-shadow:none;
        text-align:right;
        padding: 8px 8px;
        border-radius: 0;
        display:flex;
        justify-content:space-between;
        gap:12px;
      }
      tbody td::before{
        content: attr(data-label);
        font-weight: 900;
        color:#334155;
      }
      .row-actions{ justify-content:flex-start; }
      .field{ min-width: 160px; }
    }

    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; animation:none !important; }
    }
  </style>
</head>
<body>

<div class="background"></div>

<button class="menu-btn" id="menuBtn" type="button" aria-label="فتح القائمة" onclick="toggleSidebar()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
</button>

<header>
  <div class="container header-inner">
    <div style="width:46px; height:46px; flex-shrink:0;"></div>

    <h1 class="header-title">
      الإدارة المالية
      <span class="badge">الحركات</span>
    </h1>

    <div class="header-actions">
      <a class="icon-btn" href="{{ route('lighting.index') }}" title="إضاءات" aria-label="إضاءات">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6m-3-16a7 7 0 00-7 7c0 3.866 3.134 7 7 7s7-3.134 7-7a7 7 0 00-7-7z"/>
        </svg>
      </a>

      <a class="icon-btn" href="{{ route('my.profile') }}" title="حسابي" aria-label="حسابي">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="icon-btn" type="submit" title="تسجيل خروج" aria-label="تسجيل خروج">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-10V5a2 2 0 012-2h4a2 2 0 012 2v1"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</header>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar" aria-label="القائمة الجانبية">
  <div class="sidebar-header">
    <div class="sidebar-title">القائمة</div>
    <button class="close-sidebar" type="button" aria-label="إغلاق" onclick="closeSidebar()">×</button>
  </div>

  <a href="{{ route('plans.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M9 17v-6h13v6M9 5v6h13V5M3 7h2v10H3z"/>
    </svg> الخطط
  </a>

  <a href="{{ route('tasks.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
    </svg> الواجبات
  </a>

  <a href="{{ route('teachers.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg> المعلمين
  </a>

  <a href="{{ route('students.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg> الطلاب
  </a>

  <a href="{{ route('absences.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M9 17v-6h13v6M9 5v6h13V5M3 7h2v10H3z"/>
    </svg> الغيابات
  </a>

  <a href="{{ route('calendars.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg> التقويم
  </a>

  <a href="{{ route('files.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-4h4m-4 4h4"/>
    </svg> الملفات
  </a>

  <a class="active" href="{{ route('fins.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.333 0-4 1.333-4 4s2.667 4 4 4 4-1.333 4-4-2.667-4-4-4zM12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
    </svg> الإدارة المالية
  </a>

  <a href="{{ route('recitations.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
    </svg> التسميع
  </a>

  <a href="{{ route('control_page') }}">الرئيسية</a>
</aside>

<main class="container">
  <section class="hero">
    <div class="hero-top">
      <div>
        <div class="hero-title">الملخص المالي <span class="badge">الميزانية</span></div>
      </div>

      <div class="hero-actions">
        <button class="btn btn-outline" type="button" onclick="openBudgetModal()">تعديل الميزانية</button>
        <button class="btn btn-primary" type="button" onclick="openModal()">➕ إضافة حركة</button>
      </div>
    </div>

    <div class="stats">
      <div class="stat">
        <div class="label">الميزانية الحالية</div>
        <div class="value">{{ number_format($budget->budget, 2) }}</div>
      </div>
      <div class="stat">
        <div class="label">إجمالي الإيرادات</div>
        <div class="value">{{ number_format($income, 2) }}</div>
      </div>
      <div class="stat">
        <div class="label">إجمالي المصروفات</div>
        <div class="value">{{ number_format($expense, 2) }}</div>
      </div>
    </div>
  </section>

  <div class="card" style="margin-top:14px;">
    <form method="GET" action="{{ route('fins.index') }}" class="filter-bar">
      <div class="field">
        <label>نوع الحركة</label>
        <select name="type" class="form-control">
          <option value="">الكل</option>
          <option value="income" {{ request('type')=='income'?'selected':'' }}>وارد</option>
          <option value="expense" {{ request('type')=='expense'?'selected':'' }}>صادر</option>
        </select>
      </div>

      <div class="field">
        <label>من تاريخ</label>
        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
      </div>

      <div class="field">
        <label>إلى تاريخ</label>
        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
      </div>

      <div class="actions-inline">
        <button type="submit" class="btn btn-primary">فلتر</button>
        <a href="{{ route('fins.index') }}" class="btn btn-outline">إظهار الكل</a>
      </div>
    </form>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>نوع الحركة</th>
            <th>السبب</th>
            <th>الجهة</th>
            <th>المبلغ</th>
            <th>التاريخ</th>
            <th>الإجراء</th>
          </tr>
        </thead>
        <tbody>
          @forelse($fins as $transaction)
          <tr>
            <td data-label="نوع الحركة">
              <span class="type-pill {{ $transaction->type=='income'?'income':'expense' }}">
                {{ $transaction->type=='income'?'وارد':'صادر' }}
              </span>
            </td>
            <td data-label="السبب">{{ $transaction->reason }}</td>
            <td data-label="الجهة">{{ $transaction->party }}</td>
            <td data-label="المبلغ">{{ number_format($transaction->amount,2) }}</td>
            <td data-label="التاريخ">{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
            <td data-label="الإجراء">
              <div class="row-actions">
                <form method="POST" action="{{ route('financial.destroy', $transaction->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-muted">حذف</button>
                </form>

                <button class="btn btn-primary" type="button" onclick="openEditModal({{ $transaction->id }})">تعديل</button>

                <div class="modal" id="editTransactionModal{{ $transaction->id }}" role="dialog" aria-modal="true">
                  <div class="modal-content">
                    <div class="modal-head">
                      <div class="modal-title">تعديل الحركة</div>
                      <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeEditModal({{ $transaction->id }})">×</button>
                    </div>

                    <form method="POST" action="{{ route('financial.update', $transaction->id) }}" class="stack">
                      @csrf @method('PUT')

                      <div class="field" style="min-width:unset;">
                        <label>نوع الحركة</label>
                        <select name="type" class="form-control" required>
                          <option value="income" {{ $transaction->type=='income'?'selected':'' }}>وارد</option>
                          <option value="expense" {{ $transaction->type=='expense'?'selected':'' }}>صادر</option>
                        </select>
                      </div>

                      <div class="field" style="min-width:unset;">
                        <label>السبب</label>
                        <input type="text" name="reason" class="form-control" value="{{ $transaction->reason }}" required>
                      </div>

                      <div class="field" style="min-width:unset;">
                        <label>الجهة</label>
                        <input type="text" name="party" class="form-control" value="{{ $transaction->party }}" required>
                      </div>

                      <div class="field" style="min-width:unset;">
                        <label>المبلغ</label>
                        <input type="number" name="amount" class="form-control" value="{{ $transaction->amount }}" required step="0.01">
                      </div>

                      <div class="field" style="min-width:unset;">
                        <label>التاريخ</label>
                        <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}" required>
                      </div>

                      <div class="modal-actions">
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        <button type="button" class="btn btn-outline" onclick="closeEditModal({{ $transaction->id }})">إلغاء</button>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </td>
          </tr>
          @empty
            <tr>
              <td data-label="الحالة" colspan="6" style="text-align:center; color:var(--muted); padding:16px; font-weight:900;">
                لا توجد حركات مالية
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

   
  </div>
</main>

<div class="modal" id="transactionModal" role="dialog" aria-modal="true">
  <div class="modal-content">
    <div class="modal-head">
      <div class="modal-title">إضافة حركة جديدة</div>
      <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeModal()">×</button>
    </div>

    <form method="POST" action="{{ route('financial.store') }}" class="stack">
      @csrf

      <div class="field">
        <label>نوع الحركة</label>
        <select name="type" class="form-control" required>
          <option value="income">وارد</option>
          <option value="expense">صادر</option>
        </select>
      </div>

      <div class="field">
        <label>السبب</label>
        <input type="text" name="reason" class="form-control" required>
      </div>

      <div class="field">
        <label>الجهة</label>
        <input type="text" name="party" class="form-control" required>
      </div>

      <div class="field">
        <label>المبلغ</label>
        <input type="number" name="amount" class="form-control" required step="0.01">
      </div>

      <div class="field">
        <label>التاريخ</label>
        <input type="date" name="date" class="form-control" required>
      </div>

      <div class="modal-actions">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <button type="button" class="btn btn-outline" onclick="closeModal()">إلغاء</button>
      </div>
    </form>
  </div>
</div>

<div class="modal" id="budgetModal" role="dialog" aria-modal="true">
  <div class="modal-content">
    <div class="modal-head">
      <div class="modal-title">تعديل الميزانية</div>
      <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeBudgetModal()">×</button>
    </div>

    <form method="POST" action="{{ route('budget.update') }}" class="stack">
      @csrf @method('PUT')

      <div class="field">
        <label>المبلغ الجديد للميزانية</label>
        <input type="number" name="budget" class="form-control" value="{{ $budget->budget }}" required step="0.01">
      </div>

      <div class="modal-actions">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <button type="button" class="btn btn-outline" onclick="closeBudgetModal()">إلغاء</button>
      </div>
    </form>
  </div>
</div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const isOpen = sidebar.classList.toggle("open");
    overlay.classList.toggle("open", isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
  }

  function closeSidebar(){
    document.getElementById("sidebar").classList.remove("open");
    document.getElementById("overlay").classList.remove("open");
    document.body.style.overflow = '';
  }

  function openModal(){
    document.getElementById("transactionModal").classList.add("open");
    document.body.style.overflow = 'hidden';
  }
  function closeModal(){
    document.getElementById("transactionModal").classList.remove("open");
    document.body.style.overflow = '';
  }

  function openEditModal(id){
    document.getElementById("editTransactionModal"+id).classList.add("open");
    document.body.style.overflow = 'hidden';
  }
  function closeEditModal(id){
    document.getElementById("editTransactionModal"+id).classList.remove("open");
    document.body.style.overflow = '';
  }

  function openBudgetModal(){
    document.getElementById("budgetModal").classList.add("open");
    document.body.style.overflow = 'hidden';
  }
  function closeBudgetModal(){
    document.getElementById("budgetModal").classList.remove("open");
    document.body.style.overflow = '';
  }

  document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
      if(e.target === modal){
        modal.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  });

  document.addEventListener('keydown', (e) => {
    if(e.key === 'Escape'){
      closeSidebar();
      closeModal();
      closeBudgetModal();
      document.querySelectorAll('[id^="editTransactionModal"]').forEach(m => m.classList.remove('open'));
      document.body.style.overflow = '';
    }
  });
</script>

</body>
</html>