<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>التقويم</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css" rel="stylesheet" />

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
      text-decoration:none;
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
    .sidebar-title{ font-size:18px; font-weight:900; }
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
      font-weight: 800;
    }
    .sidebar a:hover{
      background: rgba(255,236,29,.92);
      color:#111827;
      transform: translateX(-2px);
    }
    .sidebar a.active{
      background: rgba(255,255,255,.18);
      border-color: rgba(255,255,255,.24);
    }

    /* ===== Main ===== */
    main{ padding: 18px 0 70px; }

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
      font-weight: 700;
    }
    .hero-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      justify-content:flex-end;
      flex: 1 1 auto;
    }

    .card{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 16px;
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
    .btn-danger{ background: var(--danger); color:#fff; }
    .btn-danger:hover{ filter: brightness(.96); transform: translateY(-1px); }

    /* Table */
    .table-wrap{ overflow:auto; margin-top: 14px; }
    table{
      width:100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      min-width: 820px;
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

    .empty{
      text-align:center;
      color:var(--muted);
      padding:16px;
      font-weight:900;
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
      width: min(980px, 100%);
      max-height: 88vh;
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

    @keyframes pop{
      from{ opacity:0; transform: translateY(10px) scale(.985); }
      to{ opacity:1; transform: translateY(0) scale(1); }
    }

    /* FullCalendar tweaks */
    #fullCalendar{ width:100%; }
    .fc .fc-toolbar-title{ font-weight: 900; }
    .fc-event-title{
      white-space: normal !important;
      overflow: visible !important;
      text-overflow: unset !important;
      line-height: 1.4;
      font-size: 13px;
      font-weight: 800;
      padding: 2px 4px;
    }

    /* Responsive */
    @media (max-width: 820px){
      .header-title{ font-size: 20px; }
      .menu-btn{ top: 14px; right: 14px; }
      table{ min-width: 760px; }
    }

    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .header-inner{ padding: 12px 0; }
      .header-title{ margin:0; max-width: 64vw; }

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

      .modal-content{ padding: 14px; }
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
        التقويم
        <span class="badge">Calendar</span>
      </h1>

      <div class="header-actions">
        <a class="icon-btn" href="{{ route('my.profile') }}" title="حسابي" aria-label="حسابي">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="icon-btn" type="submit" title="تسجيل خروج" aria-label="تسجيل خروج">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
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

    <a href="{{ route('home') }}">الرئيسية</a>
    <a href="{{ route('my.absences') }}">غياباتي</a>
    <a href="{{ route('my.profile') }}">ملفي الشخصي</a>
    <a class="active" href="{{ route('my.calendar') }}">التقويم</a>
    <a href="{{ route('my.plan') }}">خطتي</a>
    <a href="{{ route('s_index') }}">مهامي</a>
  </aside>

  <main class="container">
    <section class="hero">
      <div class="hero-top">
        <div>
          <div class="hero-title">تقويم الطالب</div>
        </div>

        <div class="hero-actions">
          <button class="btn btn-primary" type="button" onclick="openCalendar()">📅 عرض التقويم</button>
        </div>
      </div>
    </section>

    <div class="card" style="margin-top:14px;">
      <div style="display:flex; justify-content:space-between; align-items:center; gap:10px; flex-wrap:wrap;">
        <div style="font-weight:900; color:var(--primary);">الأهداف</div>
        <span class="pill">عدد السجلات: {{ $calendar->count() }}</span>
      </div>

      <div class="table-wrap" style="margin-top:10px;">
        <table aria-label="تقويم الطلاب">
          <thead>
            <tr>
              <th>التاريخ</th>
              <th>الهدف</th>
            </tr>
          </thead>
          <tbody>
            @forelse($calendar as $item)
              <tr>
                <td data-label="التاريخ">
                  <span class="pill">{{ \Carbon\Carbon::parse($item->date)->format('Y-m-d') }}</span>
                </td>
                <td data-label="الهدف">{{ $item->goal ?? '-' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="2" class="empty">لا توجد أهداف في التقويم حالياً.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal -->
  <div class="modal" id="calendarModal" role="dialog" aria-modal="true">
    <div class="modal-content">
      <div class="modal-head">
        <div class="modal-title">التقويم</div>
        <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeCalendar()">×</button>
      </div>

      <div id="fullCalendar"></div>

      <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:12px;">
        <button class="btn btn-outline" type="button" onclick="closeCalendar()">إغلاق</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>

  <!-- JSON آمن للأحداث -->
  <script type="application/json" id="calendarEventsJson">
    {!! json_encode(
      $calendar->map(function($item){
        return [
          'title' => $item->goal ?? '-',
          'start' => \Carbon\Carbon::parse($item->date)->format('Y-m-d')
        ];
      })->values(),
      JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    ) !!}
  </script>

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

    // Modal Calendar
    const modal = document.getElementById("calendarModal");
    const calendarEl = document.getElementById("fullCalendar");

    function getEvents(){
      try{
        const raw = document.getElementById("calendarEventsJson").textContent || "[]";
        return JSON.parse(raw);
      }catch(e){
        return [];
      }
    }

    function openCalendar(){
      modal.classList.add("open");
      document.body.style.overflow = "hidden";

      if(!window._studentCalendar){
        window._studentCalendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'ar',
          height: 'auto',
          dayMaxEvents: true,
          events: getEvents(),
          eventContent: function(arg) {
            return { html: '<div style="white-space:normal;">' + (arg.event.title || '') + '</div>' };
          }
        });
      }else{
        window._studentCalendar.removeAllEvents();
        window._studentCalendar.addEventSource(getEvents());
      }

      window._studentCalendar.render();
      window._studentCalendar.updateSize();
    }

    function closeCalendar(){
      modal.classList.remove("open");
      document.body.style.overflow = "";
    }

    // close on backdrop click
    modal.addEventListener('click', (e) => {
      if(e.target === modal){
        closeCalendar();
      }
    });

    // ESC closes all
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape'){
        closeCalendar();
        closeSidebar();
      }
    });
  </script>
</body>
</html>