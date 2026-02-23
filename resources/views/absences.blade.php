<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>إدارة الغيابات</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      --danger:#ef4444;
      --success:#16a34a;
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
    a{color:inherit;}
    button{font-family:inherit;}
    .container{
      width:min(1200px, calc(100% - 32px));
      margin-inline:auto;
    }

    /* Background */
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

    /* ===== Header ===== */
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

    /* ===== Menu Button ===== */
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

    /* ===== Sidebar + Overlay ===== */
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

    /* ===== Main ===== */
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
      letter-spacing:.2px;
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

    /* Cards */
    .card{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 16px;
    }

    .stats{
      margin-top: 14px;
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
    }
    .stat{
      border-radius: 18px;
      padding: 14px;
      background: rgba(255,255,255,.92);
      border: 1px solid rgba(255,255,255,.85);
      box-shadow: var(--shadow-sm);
    }
    .stat b{
      display:block;
      font-size: 18px;
      color: var(--primary);
      font-weight: 900;
    }
    .stat span{
      display:block;
      font-size: 13px;
      color: var(--muted);
      margin-top: 2px;
      font-weight: 700;
    }

    /* Filter / tools */
    .filter-grid{
      display:flex;
      gap:12px;
      align-items:end;
      flex-wrap:wrap;
    }
    .field{
      display:flex;
      flex-direction:column;
      gap:6px;
      min-width: 180px;
    }
    label{ font-weight:900; color:#334155; font-size:13px; }

    .form-control{
      width:100%;
      padding: 11px 12px;
      border-radius: 14px;
      border: 1px solid var(--border);
      font-size: 14px;
      background:#fff;
      transition:.2s;
      outline:none;
    }
    .form-control:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 3px rgba(37,99,235,.18);
    }

    .search{
      min-width: 240px;
      flex: 1 1 320px;
      max-width: 520px;
      position: relative;
    }
    .search input{ padding-right: 42px; }
    .search svg{
      position:absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px; height: 18px;
      color: #64748b;
      pointer-events:none;
    }

    /* Buttons */
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
    .btn-danger{ background: var(--danger); color:#fff; }
    .btn-danger:hover{ filter: brightness(.96); transform: translateY(-1px); }
    .btn-outline{
      background:#fff;
      border-color: var(--border);
      color: var(--text);
    }
    .btn-outline:hover{ background:#f9fafb; transform: translateY(-1px); }

    .btn-icon{
      width: 42px;
      height: 42px;
      padding: 0;
      border-radius: 14px;
    }

    /* Table */
    .table-wrap{ overflow:auto; margin-top: 14px; }
    table{
      width:100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      min-width: 900px;
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

    .pill{
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
    }

    .row-actions{
      display:flex;
      gap:8px;
      justify-content:center;
      flex-wrap: wrap;
    }

    /* Modal */
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
      width: min(920px, 100%);
      max-height: 86vh;
      overflow:auto;
      background:#fff;
      border-radius: 22px;
      border: 1px solid var(--border);
      box-shadow: 0 24px 60px rgba(0,0,0,.30);
      padding: 18px;
      animation: pop .18s ease;
    }
    .modal-head{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-bottom: 12px;
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

    .stack{ display:flex; flex-direction:column; gap: 10px; }
    .hint{ font-size: 12px; color: var(--muted); margin-top: 6px; font-weight: 700; }

    .modal table{
      min-width: 720px;
      border-collapse: collapse;
      border-spacing: 0;
    }
    .modal th{
      background: var(--primary-2);
      color:#fff;
      padding: 10px;
      text-align:center;
      position: sticky;
      top: 0;
      z-index: 2;
    }
    .modal td{
      padding: 10px;
      text-align:center;
      border-bottom: 1px solid var(--border);
    }

    @keyframes pop{
      from{ opacity:0; transform: translateY(10px) scale(.985); }
      to{ opacity:1; transform: translateY(0) scale(1); }
    }

    /* Floating button for mobile */
    .fab{
      position: fixed;
      left: 18px;
      bottom: 18px;
      z-index: 1200;
      width: 56px;
      height: 56px;
      border-radius: 999px;
      background: var(--primary-2);
      color:#fff;
      border: none;
      box-shadow: 0 18px 36px rgba(0,0,0,.25);
      cursor:pointer;
      display:none;
      align-items:center;
      justify-content:center;
      transition: .2s;
    }
    .fab:hover{ transform: scale(1.05); filter: brightness(.96); }
    .fab svg{ width: 22px; height: 22px; }

    /* Responsive */
    @media (max-width: 1024px){
      .stats{ grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 820px){
      .header-title{ font-size: 20px; }
      .menu-btn{ top: 14px; right: 14px; }
      .field{ min-width: 160px; }
      table{ min-width: 820px; }
    }

    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .header-inner{ padding: 12px 0; }
      .header-title{ margin:0; max-width: 64vw; }

      .stats{ grid-template-columns: 1fr; }
      .hero-actions{ justify-content:flex-start; }
      .fab{ display:flex; }

      /* table -> cards */
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
    }

    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; animation:none !important; }
    }
  </style>
</head>

<body>
  <div class="background"></div>

  <!-- زر القائمة -->
  <button class="menu-btn" id="menuBtn" type="button" aria-label="فتح القائمة" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <!-- الهيدر -->
  <header>
    <div class="container header-inner">
      <div style="width:46px; height:46px; flex-shrink:0;"></div>

      <h1 class="header-title">
        إدارة الغيابات
        <span class="badge">لوحة</span>
      </h1>

      <div class="header-actions">
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

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <!-- القائمة الجانبية -->
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

    <a class="active" href="{{ route('absences.index') }}">
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

    <a href="{{ route('fins.index') }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 8c-1.333 0-4 1.333-4 4s2.667 4 4 4 4-1.333 4-4-2.667-4-4-4zM12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
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
    <!-- HERO -->
    <section class="hero">
      <div class="hero-top">
        <div>
          

        <div class="hero-actions">
          <div class="search">
            <input id="searchInput" type="text" class="form-control" placeholder="ابحث باسم الطالب..." oninput="applySearch()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>

          <button class="btn btn-primary" type="button" onclick="openModal()">➕ تسجيل غياب</button>
        </div>
      </div>

   
    </section>

    <!-- فلتر التاريخ -->
    <div class="card" style="margin-top:14px;">
      <form method="GET" action="{{ route('absences.index') }}" class="filter-grid">
        <div class="field">
          <label for="from_date">من</label>
          <input type="date" id="from_date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <div class="field">
          <label for="to_date">إلى</label>
          <input type="date" id="to_date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
          <button type="submit" class="btn btn-primary">تطبيق الفلتر</button>
          <a href="{{ route('absences.index') }}" class="btn btn-outline">إظهار الكل</a>
        </div>
      </form>
    </div>

    <!-- جدول الغيابات -->
    <div class="card" style="margin-top:14px;">
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>اسم الطالب</th>
              <th>التاريخ</th>
              <th>العذر</th>
              <th>عدد الغيابات</th>
              <th>الإجراء</th>
            </tr>
          </thead>

          <tbody id="absencesTbody">
            @forelse($absences as $absence)
              <tr class="absence-row"
                  data-search="{{ mb_strtolower(($absence->student->name ?? '').' '.(\Carbon\Carbon::parse($absence->date)->format('Y-m-d')).' '.($absence->reason ?? '')) }}">
                <td data-label="اسم الطالب">{{ $absence->student->name }}</td>
                <td data-label="التاريخ">{{ \Carbon\Carbon::parse($absence->date)->format('Y-m-d') }}</td>
                <td data-label="العذر">{{ $absence->reason ?? '-' }}</td>
                <td data-label="عدد الغيابات">
                  <span class="pill">{{ $absence->student->absences_count }}</span>
                </td>

                <td data-label="الإجراء">
                  <div class="row-actions">
                    <button type="button" class="btn btn-primary" onclick="openEditModal({{ $absence->id }})">تعديل</button>

                    <form method="POST" action="{{ route('absences.destroy', $absence->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                  </div>

                  <!-- مودال التعديل -->
                  <div class="modal" id="editAbsenceModal{{ $absence->id }}" role="dialog" aria-modal="true">
                    <div class="modal-content">
                      <div class="modal-head">
                        <div class="modal-title">تعديل الغياب</div>
                        <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeEditModal({{ $absence->id }})">×</button>
                      </div>

                      <form method="POST" action="{{ route('absences.update', $absence->id) }}" class="stack">
                        @csrf
                        @method('PUT')

                        <div class="field" style="min-width:unset;">
                          <label>التاريخ</label>
                          <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($absence->date)->format('Y-m-d') }}" required>
                        </div>

                        <div class="field" style="min-width:unset;">
                          <label>العذر</label>
                          <input type="text" name="reason" class="form-control" value="{{ $absence->reason }}">
                          <div class="hint">اختياري — اتركه فارغًا إذا لا يوجد عذر.</div>
                        </div>

                        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:6px;">
                          <button type="submit" class="btn btn-primary">حفظ</button>
                          <button type="button" class="btn btn-outline" onclick="closeEditModal({{ $absence->id }})">إلغاء</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr id="emptyRow">
                <td data-label="الحالة" colspan="5" style="text-align:center; color:var(--muted); padding:16px; font-weight:900;">
                  لا توجد غيابات
                </td>
              </tr>
            @endforelse

            <tr id="noResultsRow" style="display:none;">
              <td data-label="الحالة" colspan="5" style="text-align:center; color:var(--muted); padding:16px; font-weight:900;">
                لا توجد نتائج مطابقة للبحث
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Floating action button (mobile) -->
  <button class="fab" type="button" onclick="openModal()" aria-label="تسجيل غياب">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
    </svg>
  </button>

  <!-- مودال تسجيل جديد -->
  <div class="modal" id="absenceModal" role="dialog" aria-modal="true">
    <div class="modal-content">
      <div class="modal-head">
        <div class="modal-title">تسجيل الغياب</div>
        <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeModal()">×</button>
      </div>

      <form method="POST" action="{{ route('absences.store') }}" class="stack">
        @csrf

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>اسم الطالب</th>
                <th>غياب</th>
                <th>العذر</th>
              </tr>
            </thead>
            <tbody>
              @foreach($students as $student)
                <tr>
                  <td data-label="اسم الطالب">{{ $student->name }}</td>
                  <td data-label="غياب">
                    <input type="checkbox"
                           name="absent[{{ $student->id }}]"
                           class="absence-checkbox"
                           data-target="reason-{{ $student->id }}"
                           aria-label="تحديد غياب {{ $student->name }}">
                  </td>
                  <td data-label="العذر">
                    <input type="text"
                           name="reason[{{ $student->id }}]"
                           id="reason-{{ $student->id }}"
                           class="form-control"
                           placeholder="أدخل العذر"
                           disabled>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
          <button type="submit" class="btn btn-primary">حفظ الغيابات</button>
          <button type="button" class="btn btn-outline" onclick="closeModal()">إلغاء</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Sidebar
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

    // Modals
    function openModal() {
      document.getElementById("absenceModal").classList.add("open");
      document.body.style.overflow = 'hidden';
    }
    function closeModal() {
      document.getElementById("absenceModal").classList.remove("open");
      document.body.style.overflow = '';
    }

    function openEditModal(id) {
      document.getElementById("editAbsenceModal" + id).classList.add("open");
      document.body.style.overflow = 'hidden';
    }
    function closeEditModal(id) {
      document.getElementById("editAbsenceModal" + id).classList.remove("open");
      document.body.style.overflow = '';
    }

    // Close modal on backdrop click
    document.querySelectorAll('.modal').forEach(modal => {
      modal.addEventListener('click', (e) => {
        if(e.target === modal){
          modal.classList.remove('open');
          document.body.style.overflow = '';
        }
      });
    });

    // ESC close all
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape'){
        closeModal();
        closeSidebar();
        document.querySelectorAll('[id^="editAbsenceModal"]').forEach(m => m.classList.remove('open'));
        document.body.style.overflow = '';
      }
    });

    // Enable reason input when checkbox checked
    document.querySelectorAll('.absence-checkbox').forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        const targetId = this.dataset.target;
        const reasonInput = document.getElementById(targetId);
        if(!reasonInput) return;
        reasonInput.disabled = !this.checked;
        if(this.checked) reasonInput.focus();
        if(!this.checked) reasonInput.value = '';
      });
    });

    // Front-end search
    function applySearch(){
      const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
      const rows = document.querySelectorAll('.absence-row');
      const noResultsRow = document.getElementById('noResultsRow');
      let shown = 0;

      rows.forEach(r => {
        const hay = (r.getAttribute('data-search') || '');
        const ok = !q || hay.includes(q);
        r.style.display = ok ? '' : 'none';
        if(ok) shown++;
      });

      if(noResultsRow){
        noResultsRow.style.display = (q && shown === 0) ? '' : 'none';
      }
    }
  </script>
</body>
</html>