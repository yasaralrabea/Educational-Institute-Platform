{{-- resources/views/files.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الملفات</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">

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
      --danger:#ef4444;
      --shadow: 0 12px 34px rgba(15,23,42,.10);
      --shadow-sm: 0 6px 18px rgba(15,23,42,.08);
      --radius: 22px;
    }

    *{ box-sizing:border-box; margin:0; padding:0; }
    body{
      font-family:"Cairo",Tahoma,sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.65;
      min-height:100vh;
    }
    a{ color:inherit; text-decoration:none; }
    button{ font-family:inherit; }

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

    /* Header */
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
    .icon-btn svg{ width:22px; height:22px; }

    /* Menu button */
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

    /* Sidebar */
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
    .sidebar h2{ font-size:18px; font-weight:900; }
    .close-btn{
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
    .close-btn:hover{ background: rgba(255,255,255,.20); }

    .sidebar a{
      display:flex;
      align-items:center;
      gap:12px;
      padding: 12px 12px;
      border-radius: 16px;
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
    .sidebar a.active{
      background: rgba(255,236,29,.92);
      color:#111827;
    }
    .sidebar a svg{ width:22px; height:22px; flex-shrink:0; }

    /* Main */
    main{ padding: 22px 0 80px; }

    .page-head{
      margin-top: 18px;
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
    }
    .page-title{
      color: var(--primary);
      font-size: 20px;
      font-weight: 900;
      display:flex;
      align-items:center;
      gap:10px;
    }
    .page-sub{
      color: var(--muted);
      font-size: 14px;
      margin-top: 6px;
    }

    /* Tools */
    .tools{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      justify-content:flex-end;
      flex: 1 1 auto;
    }
    .search{
      position:relative;
      min-width: 240px;
      flex: 1 1 360px;
      max-width: 520px;
    }
    .search input{
      width:100%;
      padding: 12px 42px 12px 12px;
      border-radius: 16px;
      border: 1px solid var(--border);
      background:#fff;
      outline:none;
      transition:.2s;
      font-size: 14px;
    }
    .search input:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 3px rgba(37,99,235,.14);
    }
    .search svg{
      position:absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      color: #64748b;
      pointer-events:none;
    }

    .pill{
      display:flex;
      align-items:center;
      gap:8px;
      padding: 10px 12px;
      border-radius: 16px;
      border: 1px solid var(--border);
      background:#fff;
      box-shadow: var(--shadow-sm);
      user-select:none;
    }
    .pill select{
      border:none;
      outline:none;
      background:transparent;
      font-family:inherit;
      font-weight:900;
      color: #0f172a;
      cursor:pointer;
    }

    /* Grid cards */
    .grid{
      margin-top: 14px;
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .card{
      background: rgba(255,255,255,.94);
      border: 1px solid rgba(255,255,255,.82);
      border-radius: 22px;
      box-shadow: var(--shadow);
      overflow:hidden;
      transition: transform .22s, box-shadow .22s, background .22s;
      display:flex;
      flex-direction:column;
      min-height: 230px;
    }
    .card:hover{
      transform: translateY(-6px);
      box-shadow: 0 18px 46px rgba(0,0,0,.16);
      background:#fff;
    }

    .card-media{
      position:relative;
      width:100%;
      height: 90px;
      background: linear-gradient(120deg, rgba(37,99,235,.14), rgba(255,236,29,.18));
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .file-icon{
      width: 52px;
      height: 52px;
      border-radius: 18px;
      background:#fff;
      border: 1px solid var(--border);
      box-shadow: var(--shadow-sm);
      display:flex;
      align-items:center;
      justify-content:center;
      color: var(--primary-2);
    }
    .file-icon svg{ width: 26px; height: 26px; }

    .card-body{
      padding: 14px 14px 16px;
      display:flex;
      flex-direction:column;
      gap: 10px;
      flex: 1 1 auto;
    }

    .card-title{
      font-size: 16px;
      font-weight: 900;
      color: var(--primary);
      line-height: 1.35;
      overflow:hidden;
      text-overflow: ellipsis;
      display:-webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }

    .meta{
      display:flex;
      flex-wrap:wrap;
      gap:8px;
      color: var(--muted);
      font-size: 13px;
      font-weight: 700;
    }
    .tag{
      font-size: 12px;
      font-weight: 900;
      padding: 6px 10px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: #f8fafc;
      color:#334155;
      white-space:nowrap;
    }

    .card-actions{
      margin-top:auto;
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      justify-content:flex-end;
      padding: 0 14px 14px;
    }

    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      padding: 10px 14px;
      border-radius: 14px;
      border: 1px solid transparent;
      cursor:pointer;
      font-weight: 900;
      font-size: 13px;
      transition:.2s;
      white-space:nowrap;
      user-select:none;
    }
    .btn svg{ width:18px; height:18px; }
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

    /* Empty */
    .empty{
      margin-top: 16px;
      background:#fff;
      border: 1px dashed #dbe3f0;
      border-radius: 22px;
      padding: 22px;
      box-shadow: var(--shadow-sm);
      display:flex;
      gap:12px;
      align-items:flex-start;
    }
    .empty .ic{
      width:52px;height:52px;border-radius:18px;
      display:flex;align-items:center;justify-content:center;
      border:1px solid var(--border);
      background:#f8fafc;
      color: var(--primary-2);
      flex-shrink:0;
    }
    .empty h3{ font-size: 16px; font-weight: 900; color: var(--primary); margin-bottom: 4px; }
    .empty p{ color: var(--muted); font-size: 13px; }

    /* Floating add */
    .add-btn{
      position: fixed;
      bottom: 22px;
      left: 22px;
      background: var(--primary-2);
      color:#fff;
      border:none;
      padding: 14px 16px;
      border-radius: 16px;
      font-size: 14px;
      font-weight: 900;
      cursor:pointer;
      box-shadow: 0 16px 34px rgba(0,0,0,0.22);
      z-index: 1200;
      transition: .2s;
    }
    .add-btn:hover{ filter: brightness(.96); transform: translateY(-1px); }

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
      overflow:auto;
    }
    .modal.open{ display:flex; }

    .modal-content{
      width: min(560px, 100%);
      max-height: 88vh;
      overflow:auto;
      background:#fff;
      border-radius: 22px;
      border: 1px solid var(--border);
      box-shadow: 0 24px 60px rgba(0,0,0,.30);
      padding: 18px;
      animation: pop .18s ease;
      position:relative;
    }

    .modal-head{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eef2f7;
      margin-bottom: 12px;
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
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .x-btn:hover{ background:#eef2f7; }

    .stack{ display:flex; flex-direction:column; gap: 12px; }
    .field{ display:flex; flex-direction:column; gap:6px; }
    label{ font-weight:900; color:#334155; font-size: 13px; }

    .control{
      width:100%;
      padding: 11px 12px;
      border-radius: 14px;
      border: 1px solid var(--border);
      font-size: 14px;
      background:#fff;
      outline:none;
      transition:.2s;
    }
    .control:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 3px rgba(37,99,235,.18);
    }

    .modal-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      margin-top: 6px;
      justify-content:flex-end;
    }

    @keyframes pop{
      from{ opacity:0; transform: translateY(10px) scale(.985); }
      to{ opacity:1; transform: translateY(0) scale(1); }
    }

    @media (max-width: 1024px){ .grid{ grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px){
      .grid{ grid-template-columns: 1fr; }
      .add-btn{ left: 14px; bottom: 14px; }
      .container{ width: calc(100% - 24px); }
      .search{ min-width: 0; flex: 1 1 auto; max-width: 100%; }
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
        الملفات
        <span class="badge">عدد: {{ $files->count() }}</span>
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

  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <div class="sidebar" id="sidebar" aria-label="القائمة الجانبية">
    <div class="sidebar-header">
      <h2>القائمة</h2>
      <button class="close-btn" type="button" aria-label="إغلاق" onclick="closeSidebar()">×</button>
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

    <a class="active" href="{{ route('files.index') }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6"/>
      </svg> الملفات
    </a>

    <a href="{{ route('fins.index') }}">
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
  </div>

  <main class="container">
    <div class="page-head">
      <div>
        <div class="page-title">
          قائمة الملفات
          <span class="badge" style="background:rgba(37,99,235,.16);border-color:rgba(37,99,235,.22);color:#0b3aa6;">إدارة</span>
        </div>
      </div>

      <div class="tools">
        <div class="search">
          <input id="searchInput" type="text" placeholder="ابحث باسم الملف أو نوعه..." oninput="applyFilters()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>

        <div class="pill" title="فلترة حسب النوع">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;color:#64748b;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18l-7 8v6l-4 2v-8L3 4z"/>
          </svg>
          <select id="typeFilter" onchange="applyFilters()">
            <option value="">كل الأنواع</option>
            @php
              $types = $files->pluck('type')->filter()->unique()->values();
            @endphp
            @foreach($types as $t)
              <option value="{{ $t }}">{{ $t }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    @if($files->count() === 0)
      <div class="empty">
        <div class="ic" aria-hidden="true">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6"/>
          </svg>
        </div>
        <div>
          <h3>لا توجد ملفات حالياً</h3>
          <p>ابدأ بإضافة أول ملف لك من زر “إضافة ملف”.</p>
        </div>
      </div>
    @else
      <section class="grid" id="filesGrid">
        @foreach($files as $file)
          <article class="card file-item"
                   data-name="{{ mb_strtolower($file->name ?? '') }}"
                   data-type="{{ mb_strtolower($file->type ?? '') }}">
            <div class="card-media">
              <div class="file-icon" title="ملف">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6"/>
                </svg>
              </div>
            </div>

            <div class="card-body">
              <div class="card-title" title="{{ $file->name }}">{{ $file->name }}</div>

              <div class="meta">
                <span class="tag">النوع: {{ $file->type ?? 'غير محدد' }}</span>
                <span class="tag">#{{ $file->id }}</span>
              </div>

              <div class="card-actions">
                <a class="btn btn-primary" href="{{ asset('storage/'.$file->path) }}" target="_blank" rel="noopener">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l4-4m-4 4l-4-4M4 17v3h16v-3"/>
                  </svg>
                  تحميل
                </a>

                <button class="btn btn-outline" type="button" onclick="openEditModal({{ $file->id }})">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687 1.687a1.5 1.5 0 010 2.121L8.25 18.594 4 19.75l1.156-4.25L16.862 4.487z"/>
                  </svg>
                  تعديل
                </button>

                <form method="POST" action="{{ route('files.destroy', $file->id) }}"
                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الملف؟');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2m-9 0l1 14h8l1-14"/>
                    </svg>
                    حذف
                  </button>
                </form>
              </div>
            </div>
          </article>

          {{-- Edit Modal --}}
          <div id="editModal{{ $file->id }}" class="modal" role="dialog" aria-modal="true">
            <div class="modal-content" onclick="event.stopPropagation()">
              <div class="modal-head">
                <div class="modal-title">تعديل الملف</div>
                <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeEditModal({{ $file->id }})">×</button>
              </div>

              <form method="POST" action="{{ route('files.update', $file->id) }}" enctype="multipart/form-data" class="stack">
                @csrf
                @method('PUT')

                <div class="field">
                  <label>اسم الملف</label>
                  <input class="control" type="text" name="name" value="{{ $file->name }}" placeholder="اسم الملف">
                </div>

                <div class="field">
                  <label>استبدال الملف (اختياري)</label>
                  <input class="control" type="file" name="file">
                  <div style="color:#64748b;font-size:12px;font-weight:700;">اتركه فارغًا إذا لا تريد تغيير الملف الحالي.</div>
                </div>

                <div class="modal-actions">
                  <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                  <button class="btn btn-outline" type="button" onclick="closeEditModal({{ $file->id }})">إلغاء</button>
                </div>
              </form>
            </div>
          </div>
        @endforeach
      </section>
    @endif
  </main>

  <button class="add-btn" type="button" onclick="openAddModal()">➕ إضافة ملف</button>

  {{-- Add Modal --}}
  <div id="addFileModal" class="modal" role="dialog" aria-modal="true">
    <div class="modal-content" onclick="event.stopPropagation()">
      <div class="modal-head">
        <div class="modal-title">إضافة ملف جديد</div>
        <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeAddModal()">×</button>
      </div>

      <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data" class="stack">
        @csrf

        <div class="field">
          <label>اسم الملف</label>
          <input class="control" type="text" name="name" placeholder="اسم الملف" required>
        </div>

        <div class="field">
          <label>الملف</label>
          <input class="control" type="file" name="file" required>
        </div>

        <div class="modal-actions">
          <button class="btn btn-primary" type="submit">إضافة</button>
          <button class="btn btn-outline" type="button" onclick="closeAddModal()">إلغاء</button>
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
  function openAddModal(){
    document.getElementById('addFileModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeAddModal(){
    document.getElementById('addFileModal').classList.remove('open');
    document.body.style.overflow = '';
  }

  function openEditModal(id){
    document.getElementById('editModal'+id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeEditModal(id){
    document.getElementById('editModal'+id).classList.remove('open');
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

  // ESC
  document.addEventListener('keydown', (e) => {
    if(e.key === 'Escape'){
      closeAddModal();
      closeSidebar();
      document.querySelectorAll('[id^="editModal"]').forEach(m => m.classList.remove('open'));
      document.body.style.overflow = '';
    }
  });

  // Search + Filter
  function applyFilters(){
    const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
    const t = (document.getElementById('typeFilter')?.value || '').trim().toLowerCase();

    const items = document.querySelectorAll('.file-item');
    items.forEach(el => {
      const name = (el.getAttribute('data-name') || '');
      const type = (el.getAttribute('data-type') || '');
      const matchQ = !q || name.includes(q) || type.includes(q);
      const matchT = !t || type === t;
      el.style.display = (matchQ && matchT) ? '' : 'none';
    });
  }
</script>
</body>
</html>