<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>إدارة المعلمين</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

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

      --shadow: 0 12px 34px rgba(15,23,42,.10);
      --shadow-sm: 0 6px 18px rgba(15,23,42,.08);
      --radius: 20px;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    html{ -webkit-text-size-adjust:100%; }
    body{
      font-family:"Cairo",sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.7;
      min-height:100vh;
      text-rendering: optimizeLegibility;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    a{color:inherit;text-decoration:none;}
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
      font-weight: 900;
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

    /* Search */
    .search{
      min-width: 240px;
      flex: 1 1 320px;
      max-width: 520px;
      position: relative;
    }
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
    .btn-outline{
      background:#fff;
      border-color: var(--border);
      color: var(--text);
    }
    .btn-outline:hover{ background:#f9fafb; transform: translateY(-1px); }

    /* Grid cards */
    .grid{
      margin-top: 14px;
      display:grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
    }

    .add-card{
      background: linear-gradient(135deg, rgba(37,99,235,.10), rgba(255,236,29,.10));
      border: 1px dashed rgba(37,99,235,.35);
      border-radius: 22px;
      padding: 18px;
      display:flex;
      flex-direction: column;
      justify-content:center;
      align-items:center;
      cursor:pointer;
      text-align:center;
      transition: .22s;
      box-shadow: var(--shadow-sm);
      min-height: 170px;
    }
    .add-card:hover{
      transform: translateY(-3px);
      box-shadow: 0 14px 30px rgba(0,0,0,.12);
      border-style: solid;
      background: linear-gradient(135deg, rgba(37,99,235,.14), rgba(255,236,29,.12));
    }
    .add-card svg{ width: 44px; height: 44px; margin-bottom: 10px; color: var(--primary-2); }
    .add-card span{ font-size: 16px; font-weight: 900; color: var(--primary); }

    .teacher-card{
      background: #fff;
      border-radius: 22px;
      padding: 16px;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border);
      cursor: pointer;
      transition: .22s;
      min-height: 170px;
      display:flex;
      flex-direction:column;
      gap:10px;
    }
    .teacher-card:hover{
      transform: translateY(-3px);
      box-shadow: 0 16px 34px rgba(0,0,0,.12);
    }
    .teacher-card .top{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:12px;
    }
    .teacher-card svg{ width: 42px; height: 42px; color: var(--primary-2); flex-shrink:0; }
    .teacher-card .name{
      font-size: 16px;
      font-weight: 900;
      color: var(--primary);
      line-height:1.4;
      margin-top: 2px;
    }
    .teacher-card .meta{
      display:flex;
      flex-direction:column;
      gap:6px;
      margin-top: 4px;
    }
    .teacher-card small{
      font-size: 13px;
      color: var(--muted);
      font-weight: 800;
      line-height:1.55;
      display:flex;
      align-items:center;
      gap:8px;
    }
    .dot{
      width:8px;height:8px;border-radius:999px;
      background: rgba(37,99,235,.35);
      flex-shrink:0;
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
      width: min(900px, 100%);
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

    .grid-form{
      display:grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
      margin-top: 10px;
    }
    .field{ display:flex; flex-direction:column; gap:6px; }
    label{ font-weight:900; color:#334155; font-size:13px; }

    .modal-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      margin-top: 12px;
    }
    .btn-block{ flex: 1 1 200px; }

    @keyframes pop{
      from{ opacity:0; transform: translateY(10px) scale(.985); }
      to{ opacity:1; transform: translateY(0) scale(1); }
    }

    /* Toast */
    .toast-wrap{
      position: fixed;
      top: 84px;
      left: 18px;
      right: 18px;
      z-index: 1400;
      display:flex;
      justify-content:center;
      pointer-events:none;
    }
    .toast{
      pointer-events:auto;
      width: min(760px, 100%);
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 18px;
      box-shadow: 0 18px 40px rgba(0,0,0,.18);
      padding: 12px 14px;
      display:flex;
      align-items:flex-start;
      gap:12px;
      animation: pop .18s ease;
    }
    .toast .bar{
      width:10px;
      border-radius: 999px;
      background: var(--success);
      flex-shrink:0;
      margin-top: 2px;
    }
    .toast.error .bar{ background: var(--danger); }
    .toast b{ display:block; font-weight: 900; margin-bottom: 2px; }
    .toast p{ margin:0; color: var(--muted); font-weight: 800; font-size: 13px; }
    .toast .close{
      margin-right:auto;
      width:40px;height:40px;
      border-radius: 14px;
      border: 1px solid var(--border);
      background:#f9fafb;
      cursor:pointer;
      font-size:18px;
      line-height:1;
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
    @media (max-width: 1200px){ .grid{ grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 1024px){ .grid{ grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 820px){
      .header-title{ font-size: 20px; }
      .menu-btn{ top: 14px; right: 14px; }
      .grid-form{ grid-template-columns: 1fr; }
    }
    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .header-inner{ padding: 12px 0; }
      .header-title{ margin:0; max-width: 64vw; }
      .grid{ grid-template-columns: 1fr; }
      .fab{ display:flex; }
    }
    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; animation:none !important; }
    }
  </style>
</head>

<body>
  <div class="background"></div>

  {{-- Toast رسائل الجلسة --}}
  @if(session('success') || session('error'))
    <div class="toast-wrap" id="toastWrap">
      <div class="toast {{ session('error') ? 'error' : '' }}" role="status" aria-live="polite">
        <div class="bar"></div>
        <div style="flex:1 1 auto;">
          <b>{{ session('error') ? 'تنبيه' : 'تم بنجاح' }}</b>
          <p>{{ session('error') ?? session('success') }}</p>
        </div>
        <button class="close" type="button" aria-label="إغلاق" onclick="closeToast()">×</button>
      </div>
    </div>
  @endif

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
        إدارة المعلمين
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

    <a class="active" href="{{ route('teachers.index') }}">
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
          <div class="hero-title">إدارة المعلمين</div>
        </div>

        <div class="hero-actions">
          <div class="search">
            <input id="searchInput" type="text" class="form-control" placeholder="ابحث بالاسم أو الوظيفة أو الهاتف..." oninput="applySearch()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>

          <button class="btn btn-primary" type="button" onclick="openModal()">➕ إضافة معلم</button>
          <button class="btn btn-outline" type="button" onclick="clearSearch()">إظهار الكل</button>
        </div>
      </div>
    </section>

    <!-- Grid -->
    <section class="grid" id="teachersGrid">
      <button class="add-card" type="button" onclick="openModal()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        <span>إضافة معلم جديد</span>
      </button>

      @foreach($teachers as $teacher)
        <a
          href="{{ route('teachers.show', $teacher->id) }}"
          class="teacher-card teacher-item"
          data-search="{{ mb_strtolower(($teacher->name ?? '').' '.($teacher->position ?? '').' '.($teacher->phone ?? '')) }}"
        >
          <div class="top">
            <div>
              <div class="name">{{ $teacher->name }}</div>
              <div class="meta">
                <small><span class="dot"></span> {{ $teacher->position ?? '-' }}</small>
                <small><span class="dot"></span> {{ $teacher->phone ?? '-' }}</small>
              </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
        </a>
      @endforeach

      <div id="noResultsCard" class="teacher-card" style="display:none; cursor:default;">
        <div class="name">لا توجد نتائج</div>
        <small>جرّب تغيير كلمات البحث.</small>
      </div>
    </section>
  </main>

  <!-- Floating action button (mobile) -->
  <button class="fab" type="button" onclick="openModal()" aria-label="إضافة معلم">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
    </svg>
  </button>

  <!-- Modal: Add Teacher -->
  <div class="modal" id="teacherModal" role="dialog" aria-modal="true" aria-label="إضافة معلم">
    <div class="modal-content">
      <div class="modal-head">
        <div class="modal-title">إضافة معلم</div>
        <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeModal()">×</button>
      </div>

      <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <div class="grid-form">
          <div class="field">
            <label>الاسم</label>
            <input class="form-control" type="text" name="name" required>
          </div>

          <div class="field">
            <label>رقم الهاتف</label>
            <input class="form-control" type="text" name="phone" required>
          </div>

          <div class="field">
            <label>البريد الإلكتروني</label>
            <input class="form-control" type="email" name="email" required>
          </div>

          <div class="field">
            <label>الوظيفة</label>
            <input class="form-control" type="text" name="position" required>
          </div>

          <div class="field">
            <label>المؤهل</label>
            <input class="form-control" type="text" name="qualification" required>
          </div>

          <div class="field">
            <label>الراتب</label>
            <input class="form-control" type="text" name="salary" required>
          </div>

          <div class="field">
            <label>كلمة المرور</label>
            <input class="form-control" type="password" name="password" required>
          </div>

          <div class="field">
            <label>تأكيد كلمة المرور</label>
            <input class="form-control" type="password" name="password_confirmation" required>
          </div>
        </div>

        <div class="modal-actions">
          <button type="submit" class="btn btn-primary btn-block">إضافة</button>
          <button type="button" class="btn btn-outline btn-block" onclick="closeModal()">إلغاء</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function lockScroll(lock){
      document.body.style.overflow = lock ? 'hidden' : '';
    }

    // Toast
    function closeToast(){
      const wrap = document.getElementById('toastWrap');
      if(wrap) wrap.remove();
    }
    // إغلاق تلقائي بعد 4 ثواني (اختياري)
    setTimeout(() => closeToast(), 4000);

    // Sidebar
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");
      const isOpen = sidebar.classList.toggle("open");
      overlay.classList.toggle("open", isOpen);
      lockScroll(isOpen);
    }
    function closeSidebar(){
      document.getElementById("sidebar").classList.remove("open");
      document.getElementById("overlay").classList.remove("open");
      lockScroll(false);
    }

    // Modal
    function openModal() {
      document.getElementById("teacherModal").classList.add("open");
      lockScroll(true);
    }
    function closeModal() {
      document.getElementById("teacherModal").classList.remove("open");
      lockScroll(false);
    }

    // Backdrop click closes modal
    document.getElementById("teacherModal").addEventListener("click", (e) => {
      if(e.target.id === "teacherModal") closeModal();
    });

    // ESC closes all
    document.addEventListener("keydown", (e) => {
      if(e.key === "Escape"){
        closeModal();
        closeSidebar();
        lockScroll(false);
      }
    });

    // Search cards
    function applySearch(){
      const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
      const items = document.querySelectorAll('.teacher-item');
      const noResults = document.getElementById('noResultsCard');
      let shown = 0;

      items.forEach(el => {
        const hay = (el.getAttribute('data-search') || '');
        const ok = !q || hay.includes(q);
        el.style.display = ok ? '' : 'none';
        if(ok) shown++;
      });

      if(noResults){
        noResults.style.display = (q && shown === 0) ? '' : 'none';
      }
    }
    function clearSearch(){
      const input = document.getElementById('searchInput');
      if(input) input.value = '';
      applySearch();
    }
  </script>
</body>
</html>