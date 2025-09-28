<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>  واجهة المعلم  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* عام */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: "Cairo", "Tahoma", sans-serif; background: #f5f7fa; color: #333; }

    /* الخلفية */
    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('/a.jpg') no-repeat center center;
      background-size: cover;
      filter: blur(10px) brightness(0.7);
      z-index: -1;
    }

    /* الهيدر */
    header {
      background: linear-gradient(90deg, #253b5cff, #253b5cff);
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      position: sticky;
      top: 0;
      z-index: 900;
      min-height: 70px;
      flex-wrap: nowrap;
    }
    header h1 {
      font-size: 26px;
      font-weight: 700;
      text-align: center;
      flex: 1 1 auto;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    header .actions {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-shrink: 0;
      z-index: 1001;
    }
    header .actions a,
    header .actions button {
      background: rgba(255,255,255,0.15);
      border: none;
      color: #fff;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px 12px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    header .actions a:hover,
    header .actions button:hover { background: rgba(255,255,255,0.3); }
    header .actions svg { width: 24px; height: 24px; }

    /* زر القائمة */
    .menu-btn {
      flex-shrink: 0;
      position: fixed;
      top: 20px;
      right: 20px;
      background: #253b5cff;
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 10px 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      z-index: 1100;
    }
    .menu-btn svg { width: 26px; height: 26px; }
    .menu-btn:hover { background: #2563eb; transform: translateY(-1px); }

/* القائمة الجانبية */
.sidebar {
  position: fixed;
  top: 0;
  right: -280px;
  width: 280px;
  height: 100%;
  background: #253b5cff;
  color: #fff;
  padding: 25px 20px;
  box-shadow: -4px 0 20px rgba(0,0,0,0.3);
  transition: right 0.4s ease;
  z-index: 1000;
  border-radius: 8px 0 0 8px;
  overflow-y: auto;
}
.sidebar.open { right: 0; }
.sidebar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}
.sidebar h2 { font-size: 18px; font-weight: 700; }
.sidebar .close-btn {
  background: none;
  border: none;
  color: #fff;
  font-size: 24px;
  cursor: pointer;
}
.sidebar .close-btn:hover { color: #253b5cff; }

/* عناصر القائمة */
.sidebar a {
  display: flex;
  align-items: center;
  gap: 12px;
  background: #2d3748;
  border-radius: 14px;
  padding: 14px;
  margin-bottom: 12px;
  text-decoration: none;
  color: #fff;
  transition: all 0.25s ease;
}
.sidebar a:hover {
  background: #ffec1dff;
}
.sidebar a svg {
  width: 22px;
  height: 22px;
}
    /* محتوى البطاقات */
    main {
      padding: 100px 40px 40px 40px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }
    a.card-link { text-decoration: none; color: inherit; }

    .card {
      background: #fff;
      border-radius: 20px;
      padding: 40px 25px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(0,0,0,0.12);
      cursor: pointer;
      transition: transform 0.35s, box-shadow 0.35s;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.18); }
    .card svg { width: 60px; height: 60px; color: #253b5cff; margin-bottom: 15px; }
    .card span { display: block; font-size: 18px; font-weight: 600; color: #253b5cff; margin-top: 8px; }

    /* أيقونة الرسائل الثابتة */
    .chat-btn {
      position: fixed;
      bottom: 30px;
      left: 30px;
      width: 60px;
      height: 60px;
      background: #2563eb;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      cursor: pointer;
      transition: all 0.3s ease;
      z-index: 1200;
    }
    .chat-btn:hover { background: #1e4bb8; transform: scale(1.1); }
    .chat-btn svg { width: 28px; height: 28px; }

    /* استجابة للشاشات المتوسطة والصغيرة */
    @media (max-width: 1024px) { main { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { main { grid-template-columns: 1fr; padding: 80px 10px 20px 10px; gap: 30px; } }
  </style>
</head>
<body>

  <div class="background"></div>

  <!-- زر القائمة -->
  <button class="menu-btn" id="menuBtn" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
  </button>

  <!-- الهيدر -->
  <header>
    <h1>   واجهة المعلم</h1>
    <div class="actions">
        <a href="{{ route('lighting.index') }}" title="إضاءات">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6m-3-16a7 7 0 00-7 7c0 3.866 3.134 7 7 7s7-3.134 7-7a7 7 0 00-7-7z"/>
  </svg>
</a>
      <a href="{{ route('my.profile') }}" title="حسابي">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </a>
   

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" title="تسجيل خروج">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-10V5a2 2 0 012-2h4a2 2 0 012 2v1"/>
          </svg>
        </button>
      </form>
    </div>
  </header>
<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h2>القائمة</h2>
    <button class="close-btn" onclick="toggleSidebar()">×</button>
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

  <!-- العناصر الجديدة -->
  <a href="{{ route('files.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-4h4m-4 4h4"/>
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

  <!-- محتوى البطاقات -->
  <main>
  <a href="{{ route('plans.index') }}" class="card-link">
  <div class="card">
    <!-- أيقونة جدول خطة -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" 
            d="M3 3h18v18H3V3z M3 9h18 M9 3v18"/>
    </svg>
    <span>الخطط</span>
  </div>
</a>


    <a href="{{ route('tasks.index') }}" class="card-link">
      <div class="card">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
        </svg>
        <span>الواجبات</span>
      </div>
    </a>

    <a href="{{ route('teachers.index') }}" class="card-link">
      <div class="card">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <span>المعلمين</span>
      </div>
    </a>

    <a href="{{ route('students.index') }}" class="card-link">
      <div class="card">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <span>الطلاب</span>
      </div>
    </a>

   <a href="{{ route('absences.index') }}" class="card-link">
  <div class="card">
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke-width="2" 
         stroke="currentColor" 
         class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" 
            d="M15 14a3 3 0 10-6 0 3 3 0 006 0zM2.458 20.041A9.969 9.969 0 0112 18c2.21 0 4.21.72 5.542 1.941M18 9h6" />
    </svg>
    <span>الغيابات</span>
  </div>
</a>


    <a href="{{ route('calendars.index') }}" class="card-link">
      <div class="card">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>التقويم</span>
      </div>
    </a>

  <a href="{{ route('recitations.index') }}" class="card-link">
  <div class="card">
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke-width="2" 
         stroke="currentColor" 
         class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" 
            d="M12 6c0-.55-.45-1-1-1H6a2 2 0 00-2 2v12a2 2 0 002 2h5c.55 0 1-.45 1-1V6zm0 0c0-.55.45-1 1-1h5a2 2 0 012 2v12a2 2 0 01-2 2h-5c-.55 0-1-.45-1-1V6z" />
    </svg>
    <span>التسميع</span>
  </div>
</a>


    <a href="{{ route('fins.index') }}" class="card-link">
      <div class="card">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-4h4m-4 4h4"/>
        </svg>
        <span>الإدارة المالية</span>
      </div>
    </a>

     <a href="{{ route('files.index') }}" class="card-link">
  <div class="card">
    <!-- أيقونة مجلد -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
    </svg>
    <span>ملفات</span>
  </div>
</a>

  </main>

  <!-- أيقونة الرسائل -->
  <a href="{{ route('message.index') }}" class="chat-btn" title="المحادثة">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H7l-4 4V10a2 2 0 012-2h2"/>
    </svg>
  </a>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const menuBtn = document.getElementById("menuBtn");
    sidebar.classList.toggle("open");
    menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
  }
</script>

</body>
</html>
