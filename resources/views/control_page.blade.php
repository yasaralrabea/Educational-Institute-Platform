<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>واجهة المعلم</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#f3f6fb;
      --card:#ffffff;
      --text:#111827;
      --muted:#6b7280;
      --border:#e5e7eb;
      --primary:#253b5c;
      --primary-dark:#1f2f48;
      --primary-2:#2563eb;
      --accent:#ffec1d;
      --shadow: 0 10px 30px rgba(17,24,39,.10);
      --shadow-sm: 0 4px 14px rgba(17,24,39,.10);
      --radius: 18px;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    body{
      font-family:"Cairo","Tahoma",sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.6;
      min-height:100vh;
    }
    a{color:inherit;}
    button{font-family:inherit;}
    .container{
      width:min(1200px, calc(100% - 32px));
      margin-inline:auto;
    }

    /* خلفية أنعم */
    .background{
      position:fixed;
      inset:0;
      background:
        radial-gradient(1200px 420px at 10% 0%, rgba(37,99,235,.12), transparent 55%),
        radial-gradient(900px 360px at 90% 10%, rgba(255,236,29,.16), transparent 60%),
        #f8f8f8;
      z-index:-2;
    }

    /* ===== Header ===== */
    header{
      position: sticky;
      top: 0;
      z-index: 900;
      background: linear-gradient(90deg, var(--primary), var(--primary-dark));
      color:#fff;
      box-shadow: 0 6px 24px rgba(0,0,0,.15);
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
    .header-title .badge{
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
      border-radius:12px;
      transition:.25s;
      outline:none;
    }
    .icon-btn:hover{ background: rgba(255,255,255,.24); transform: translateY(-1px); }
    .icon-btn:focus-visible{ box-shadow: 0 0 0 3px rgba(37,99,235,.45); }
    .icon-btn svg{ width:22px; height:22px; }

    /* ===== Menu Button ===== */
    .menu-btn{
      position: fixed;
      top: 18px;
      right: 18px;
      z-index: 1100;
      width:46px;
      height:46px;
      border:none;
      border-radius: 14px;
      cursor:pointer;
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color:#fff;
      box-shadow: 0 10px 20px rgba(0,0,0,.22);
      backdrop-filter: blur(10px);
      transition: .25s;
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
      right: -320px;
      width: 300px;
      max-width: calc(100% - 48px);
      height: 100%;
      background: linear-gradient(180deg, var(--primary), var(--primary-dark));
      color:#fff;
      padding: 18px;
      box-shadow: -10px 0 30px rgba(0,0,0,.35);
      transition: right .32s ease;
      z-index: 1101;
      border-radius: 18px 0 0 18px;
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
      border-radius:12px;
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
      border-radius: 14px;
      text-decoration:none;
      color:#fff;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.10);
      margin-bottom: 10px;
      transition:.22s;
      position: relative;
      overflow: hidden;
    }
    .sidebar a:hover{
      background: rgba(255,236,29,.92);
      color:#111827;
      transform: translateX(-2px);
    }
    .sidebar a svg{ width:22px; height:22px; }

    /* (اختياري) لو بدك تميّز الصفحة الحالية */
    .sidebar a.active{
      background: rgba(255,255,255,.18);
      border-color: rgba(255,255,255,.24);
    }

    /* ===== Main ===== */
    main{ padding: 22px 0 46px; }

    .hero{
      margin-top: 18px;
      padding: 18px;
      border-radius: var(--radius);
      border: 1px solid rgba(255,255,255,.22);
      background: linear-gradient(135deg, rgba(37,99,235,.18), rgba(255,236,29,.14));
      box-shadow: 0 12px 30px rgba(0,0,0,.10);
      backdrop-filter: blur(10px);
    }
    .hero h2{
      color:#fff;
      font-size: 20px;
      font-weight: 900;
    }
    .hero p{
      color: rgba(255,255,255,.9);
      font-size: 14px;
      margin-top: 6px;
      max-width: 70ch;
    }

    .grid{
      margin-top: 18px;
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .card-link{ text-decoration:none; color:inherit; }

    .card{
      background: rgba(255,255,255,.92);
      border: 1px solid rgba(255, 255, 255, 0.86);
      border-radius: 20px;
      padding: 22px 16px;
      text-align:center;
      box-shadow: var(--shadow);
      cursor:pointer;
      transition: transform .25s, box-shadow .25s, background .25s;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      min-height: 150px;
      position: relative;
    }
    .card::after{
      content:"";
      position:absolute;
      inset:0;
      border-radius: 20px;
      pointer-events:none;
      background: radial-gradient(500px 180px at 50% -30%, rgba(37,99,235,.12), transparent 60%);
      opacity: .9;
    }
    .card:hover{
      transform: translateY(-6px);
      box-shadow: 0 16px 40px rgba(0,0,0,.16);
      background:#fff;
    }
    .card svg{
      width: 54px;
      height: 54px;
      color: var(--primary);
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
    }
    .card span{
      font-size: 16px;
      font-weight: 900;
      color: var(--primary);
      position: relative;
      z-index: 1;
    }
    .card small{
      color: var(--muted);
      font-size: 13px;
      margin-top: 4px;
      position: relative;
      z-index: 1;
    }

    /* ===== Chat button ===== */
    .chat-btn{
      position: fixed;
      bottom: 22px;
      left: 22px;
      width: 58px;
      height: 58px;
      background: var(--primary-2);
      border-radius: 50%;
      display:flex;
      align-items:center;
      justify-content:center;
      color:#fff;
      box-shadow: 0 14px 30px rgba(0,0,0,.25);
      cursor:pointer;
      transition: .25s;
      z-index: 1200;
      text-decoration:none;
    }
    .chat-btn:hover{ filter: brightness(.95); transform: scale(1.06); }
    .chat-btn svg{ width: 26px; height: 26px; }

    /* ===== Responsive ===== */
    @media (max-width: 1024px){
      .grid{ grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .menu-btn{ top: 14px; right: 14px; }
      .header-title{ font-size: 20px; max-width: 64vw; }
      .grid{ grid-template-columns: 1fr; }
      .card{ min-height: 140px; }
      .chat-btn{ left: 14px; bottom: 14px; }
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
        واجهة المعلم
        <span class="badge">لوحة التحكم</span>
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
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
      </svg> الملفات
    </a>

    <a href="{{ route('fins.index') }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 8c-1.333 0-4 1.333-4 4s2.667 4 4 4 4-1.333 4-4-2.667-4-4-4zM12 2v4M12 18v4M2 12h4M18 12h4"/>
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
    <section class="grid">
      <a href="{{ route('plans.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3z M3 9h18 M9 3v18"/>
          </svg>
          <span>الخطط</span>
          <small>إدارة الخطط القرآنية</small>
        </div>
      </a>

      <a href="{{ route('tasks.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
          </svg>
          <span>الواجبات</span>
          <small>إدارة الواجبات</small>
        </div>
      </a>

      <a href="{{ route('teachers.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>المعلمين</span>
          <small>إدارة  المعلمين</small>
        </div>
      </a>

      <a href="{{ route('students.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>الطلاب</span>
          <small>إدارة الطلاب </small>
        </div>
      </a>

      <a href="{{ route('absences.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 14a3 3 0 10-6 0 3 3 0 006 0zM2.458 20.041A9.969 9.969 0 0112 18c2.21 0 4.21.72 5.542 1.941M18 9h6" />
          </svg>
          <span>الغيابات</span>
          <small> متابعة الغياب</small>
        </div>
      </a>

      <a href="{{ route('calendars.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span>التقويم</span>
          <small> الأهداف  والمخططات</small>
        </div>
      </a>

      <a href="{{ route('recitations.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c0-.55-.45-1-1-1H6a2 2 0 00-2 2v12a2 2 0 002 2h5c.55 0 1-.45 1-1V6zm0 0c0-.55.45-1 1-1h5a2 2 0 012 2v12a2 2 0 01-2 2h-5c-.55 0-1-.45-1-1V6z" />
          </svg>
          <span>التسميع</span>
          <small>إدارة التسميع</small>
        </div>
      </a>

      <a href="{{ route('fins.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-4h4m-4 4h4"/>
          </svg>
          <span>الإدارة المالية</span>
          <small> الحركات المالية</small>
        </div>
      </a>

      <a href="{{ route('files.index') }}" class="card-link">
        <div class="card">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
          </svg>
          <span>الملفات</span>
          <small> تخزين الملفات</small>
        </div>
      </a>
    </section>
  </main>

  <!-- أيقونة الرسائل -->
  <a href="{{ route('message.index') }}" class="chat-btn" title="المحادثة" aria-label="المحادثة">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H7l-4 4V10a2 2 0 012-2h2"/>
    </svg>
  </a>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");
      const isOpen = sidebar.classList.toggle("open");
      overlay.classList.toggle("open", isOpen);

      // منع سكرول الصفحة لما القائمة مفتوحة
      document.body.style.overflow = isOpen ? 'hidden' : '';
    }

    function closeSidebar(){
      document.getElementById("sidebar").classList.remove("open");
      document.getElementById("overlay").classList.remove("open");
      document.body.style.overflow = '';
    }

    // إغلاق عند الضغط على ESC
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape'){
        closeSidebar();
      }
    });
  </script>
</body>
</html>