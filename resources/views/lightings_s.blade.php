{{-- resources/views/lightings_s.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الإضاءات - للطلاب</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* --- عام --- */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: "Cairo", "Tahoma", sans-serif; background: #f5f7fa; color: #333; }

    /* الخلفية */
    .background {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: url('/a.jpg') no-repeat center center;
      background-size: cover; filter: blur(10px) brightness(0.7); z-index: -1;
    }

    /* الهيدر */
    header {
      background: linear-gradient(90deg, #253b5cff, #253b5cff);
      color: #fff; display: flex; justify-content: space-between; align-items: center;
      padding: 20px 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      position: sticky; top: 0; z-index: 900; min-height: 70px;
    }
    header h1 { font-size: 26px; font-weight: 700; text-align: center; flex: 1 1 auto; }
    header .actions { display: flex; gap: 12px; align-items: center; flex-shrink: 0; }
    header .actions a, header .actions form button {
      background: rgba(255,255,255,0.15); border: none; color: #fff; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      padding: 10px 12px; border-radius: 8px; transition: all 0.3s ease;
    }
    header .actions a:hover, header .actions form button:hover { background: rgba(255,255,255,0.3); }
    header .actions svg { width: 24px; height: 24px; }

    /* زر القائمة */
    .menu-btn { flex-shrink: 0; position: fixed; top: 20px; right: 20px; background: #253b5cff; color: #fff;
      border: none; border-radius: 12px; padding: 10px 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      cursor: pointer; transition: background 0.3s, transform 0.2s; z-index: 1100; }
    .menu-btn svg { width: 26px; height: 26px; }
    .menu-btn:hover { background: #2563eb; transform: translateY(-1px); }

    /* القائمة الجانبية */
    .sidebar { position: fixed; top: 0; right: -280px; width: 280px; height: 100%; background: #253b5cff;
      color: #fff; padding: 25px 20px; box-shadow: -4px 0 20px rgba(0,0,0,0.3); transition: right 0.4s ease;
      z-index: 1000; border-radius: 8px 0 0 8px; overflow-y: auto; }
    .sidebar.open { right: 0; }
    .sidebar h2 { margin-bottom: 25px; font-size: 18px; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; text-align: center; }
    .sidebar a { display: flex; align-items: center; gap: 12px; color: #fff; text-decoration: none; margin-bottom: 16px;
      font-size: 16px; font-weight: 600; padding: 14px 18px; border-radius: 12px; background: #2d3748; box-shadow: 0 4px 12px rgba(0,0,0,0.25); transition: all 0.3s ease; }
    .sidebar a:hover { background: #253b5cff; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.35); }
    .close-btn { position: absolute; top: 20px; left: 20px; background: transparent; border: none; color: #fff; font-size: 26px; cursor: pointer; }

    /* محتوى الإضاءات */
    main { padding: 100px 40px 40px 40px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .card-light { background: #fff; border-radius: 20px; padding: 25px; text-align: center; box-shadow: 0 8px 25px rgba(0,0,0,0.12);
      transition: transform 0.35s, box-shadow 0.35s; display: flex; flex-direction: column; align-items: center; }
    .card-light:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,0.18); }
    .card-light img { width: 100%; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 15px; }
    .card-light h3 { font-size: 20px; font-weight: 700; color: #253b5cff; margin-bottom: 10px; }
    .card-light p { font-size: 16px; font-weight: 600; color: #555; margin-bottom: 5px; }

    @media (max-width:1024px) { main { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width:768px) { main { grid-template-columns: 1fr; padding: 80px 10px 20px 10px; gap: 30px; } }
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
    <h1>الإضاءات - للطلاب</h1>
    <div class="actions">
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

  <!-- القائمة الجانبية -->
 <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h2>القائمة</h2>
      <button class="close-btn" onclick="toggleSidebar()">×</button>
    </div>
    <a href="{{ route('home') }}">الرئيسية</a>
    <a href="{{ route('my.absences') }}">غياباتي</a>
    <a href="{{ route('my.profile') }}">ملفي الشخصي</a>
    <a href="{{ route('my.calendar') }}">التقويم</a>
    <a href="{{ route('my.plan') }}">خطتي</a>
    <a href="{{ route('s_index') }}">مهامي</a>
  </div>
  <!-- محتوى الإضاءات -->
  <main>
    @foreach($lighting as $light)
      <div class="card-light">
@if(!empty($light->photo))
    <img src="{{ $light->photo }}" alt=" ">
@endif
        <h3>{{ $light->title }}</h3>
        <p> {{ $light->lighting }}</p>
      </div>
    @endforeach
  </main>

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
