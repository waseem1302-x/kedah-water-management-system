<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Water Management System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
/* ===== Base ===== */
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: 'Segoe UI', Arial, sans-serif; background:#f4f7f9; color:#333; line-height:1.6; overflow-x:hidden; }
a { text-decoration:none; transition:0.3s; }

/* ===== Navigation ===== */
nav {
    display:flex; justify-content:space-between; align-items:center;
    padding:18px 40px; background:#0f1b2b; color:white; position:sticky; top:0; z-index:1000;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
}
nav .logo { font-size:1.6em; font-weight:700; color:#00c4b4; }
nav ul { list-style:none; display:flex; gap:18px; }
nav ul li a { color:white; font-weight:500; padding:8px 14px; border-radius:6px; }
nav ul li a:hover { background:#00c4b4; color:#0f1b2b; }

/* ===== Hero Section ===== */
.hero {
    position: relative; text-align: center; color: white;
    padding: 120px 20px; border-radius:20px; overflow:hidden; margin:20px auto; max-width:1200px;
    background: linear-gradient(135deg, #0f1b2b 0%, #00334d 100%);
}
#waterCanvas { position: absolute; top:0; left:0; width:100%; height:100%; z-index:0; }
.hero h1, .hero p, .hero .cta-buttons { position: relative; z-index:1; }
.hero h1 { font-size:3em; font-weight:800; margin-bottom:20px; color:#00c4b4; }
.hero p { font-size:1.3em; opacity:0.9; margin-bottom:35px; }
.hero .cta-buttons a {
    display:inline-block; margin:8px; padding:18px 30px; background: linear-gradient(90deg, #00c4b4, #009c86);
    color:white; font-weight:700; border-radius:12px; font-size:1em;
}
.hero .cta-buttons a:hover { background: linear-gradient(90deg, #009c86, #00c4b4); transform:translateY(-4px) scale(1.02); }

/* ===== Sections ===== */
section { max-width:1200px; margin:50px auto; padding:0 20px; }
section h2 { font-size:2em; text-align:center; margin-bottom:30px; color:#0f1b2b; }

/* ===== Features ===== */
.features { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:30px; }
.feature-card {
    background:white; border-radius:20px; padding:35px 25px; text-align:center;
    box-shadow:0 12px 25px rgba(0,0,0,0.08); transition:0.4s; cursor:pointer;
}
.feature-card:hover { transform:translateY(-8px) scale(1.03); box-shadow:0 20px 40px rgba(0,0,0,0.12); }
.feature-card i { font-size:3em; color:#00c4b4; margin-bottom:20px; }
.feature-card h3 { font-size:1.3em; font-weight:700; margin-bottom:10px; }
.feature-card p { font-size:1em; opacity:0.85; }

/* ===== Metrics ===== */
.metrics { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:30px; text-align:center; }
.metric {
    background: linear-gradient(135deg, #00c4b4, #009c86); color:white; border-radius:20px; padding:40px 25px; transition:0.3s;
}
.metric:hover { background: linear-gradient(135deg, #009c86, #00c4b4); transform:translateY(-5px) scale(1.02); }
.metric h3 { font-size:1.3em; margin-bottom:15px; font-weight:700; }
.metric p { font-size:2.2em; font-weight:800; }

/* ===== Timeline ===== */
.timeline { display:flex; flex-direction:column; gap:25px; }
.timeline-item {
    padding:20px 25px; border-left:5px solid #00c4b4; background:#ffffff; border-radius:15px; position:relative;
    transition:0.4s; cursor:pointer;
}
.timeline-item:hover { background:#e6f7f5; transform:translateX(5px) scale(1.02); }
.timeline-item::before {
    content:""; position:absolute; left:-13px; top:20px; width:18px; height:18px;
    background:#00c4b4; border-radius:50%;
}

/* ===== CTA Section ===== */
.cta-section { text-align:center; padding:70px 30px; background:#0f1b2b; color:white; border-radius:20px; }
.cta-section a {
    display:inline-block; margin-top:20px; padding:18px 35px;
    background: linear-gradient(90deg, #00c4b4, #009c86); color:white;
    font-weight:700; border-radius:12px; transition:0.3s;
}
.cta-section a:hover { background: linear-gradient(90deg, #009c86, #00c4b4); transform:translateY(-4px) scale(1.02); }

/* ===== Floating Action Button ===== */
.fab { position:fixed; bottom:30px; right:30px; background:#00c4b4; color:white;
    width:60px; height:60px; border-radius:50%; display:flex; align-items:center; justify-content:center;
    font-size:1.8em; box-shadow:0 8px 20px rgba(0,0,0,0.3); cursor:pointer; transition:0.3s; z-index:1001;
}
.fab:hover { background:#009c86; transform:scale(1.1); }

/* ===== Footer ===== */
footer { text-align:center; padding:25px 20px; background:#0f1b2b; color:white; margin-top:40px; border-radius:15px; }

/* ===== Responsive ===== */
@media(max-width:768px){
    nav { flex-direction:column; gap:15px; padding:15px 20px; }
    .hero h1 { font-size:2.4em; }
    .hero p { font-size:1.1em; }
}
</style>
</head>
<body>

<!-- Navigation -->
<nav>
    <div class="logo"><i class="fas fa-water"></i> Water Management</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="water_quality.php">Water Quality</a></li>
        <li><a href="resource_management.php">Resources</a></li>
        <li><a href="report_issue.php">Report Issue</a></li>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <li><a href="reported_issues.php">Reported Issues</a></li>
            <li><a href="profile.php">Welcome, <?=htmlspecialchars($_SESSION['username'])?></a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Hero Section -->
<section class="hero">
    <canvas id="waterCanvas"></canvas>
    <h1>Kedah Water Management System</h1>
    <p>Monitor water quality, manage resources, and report issues efficiently with a modern, intuitive interface.</p>
    <div class="cta-buttons">
        <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="water_quality.php"><i class="fas fa-tint"></i> Water Quality</a>
        <a href="resource_management.php"><i class="fas fa-cogs"></i> Resources</a>
        <a href="report_issue.php"><i class="fas fa-exclamation-triangle"></i> Report Issue</a>
    </div>
</section>

<!-- Features Section -->
<section>
    <h2>System Features</h2>
    <div class="features">
        <a href="water_quality.php" class="feature-card">
            <i class="fas fa-tint"></i>
            <h3>Water Quality Monitoring</h3>
            <p>Track water parameters and maintain quality standards.</p>
        </a>
        <a href="resource_management.php" class="feature-card">
            <i class="fas fa-cogs"></i>
            <h3>Resource Management</h3>
            <p>Manage pumps, chemicals, and maintenance schedules efficiently.</p>
        </a>
        <a href="report_issue.php" class="feature-card">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Issue Reporting</h3>
            <p>Report and track issues for immediate action.</p>
        </a>
        <a href="dashboard.php" class="feature-card">
            <i class="fas fa-chart-line"></i>
            <h3>Analytics & Dashboard</h3>
            <p>Visualize trends and metrics across all plants.</p>
        </a>
    </div>
</section>

<!-- Metrics Section -->
<section>
    <h2>Dashboard Overview</h2>
    <div class="metrics">
        <div class="metric"><h3>Total Plants</h3><p class="counter" data-target="12">0</p></div>
        <div class="metric"><h3>Pending Issues</h3><p class="counter" data-target="5">0</p></div>
        <div class="metric"><h3>Water Samples</h3><p class="counter" data-target="480">0</p></div>
        <div class="metric"><h3>Resources Monitored</h3><p class="counter" data-target="24">0</p></div>
    </div>
</section>

<!-- Timeline Section -->
<section>
    <h2>Recent Activities</h2>
    <div class="timeline">
        <div class="timeline-item"><strong>Update:</strong> Water samples collected at Plant A</div>
        <div class="timeline-item"><strong>Maintenance:</strong> Pumps scheduled for Plant B</div>
        <div class="timeline-item"><strong>Alert:</strong> Turbidity levels high at Plant C</div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <h2>Report an Issue</h2>
    <p>Help maintain water safety by reporting issues promptly.</p>
    <a href='?tab=report_issue'><i class="fas fa-exclamation-triangle"></i> Report Now</a>
</section>

<!-- Floating Action Button -->
<div class="fab" onclick="location.href='?tab=report_issue'"><i class="fas fa-plus"></i></div>

<footer>
    <p>Water Management © 2024 | All Rights Reserved</p>
</footer>

<script>
// ===== Animated Counters =====
const counters = document.querySelectorAll('.counter');
counters.forEach(counter => {
    const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / 50;
        if(count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCount, 25);
        } else counter.innerText = target;
    };
    updateCount();
});

// ===== Hero Canvas: Waves + Bubbles =====
const canvas = document.getElementById('waterCanvas');
const ctx = canvas.getContext('2d');
canvas.width = canvas.offsetWidth;
canvas.height = canvas.offsetHeight;
let width = canvas.width, height = canvas.height;

// Waves
let waves = [];
for(let i=0; i<3; i++){
    waves.push({
        amplitude: 10+Math.random()*15,
        wavelength:100+Math.random()*200,
        speed:0.02+Math.random()*0.02,
        offset: Math.random()*Math.PI*2,
        color:`rgba(255,255,255,${0.1+Math.random()*0.2})`
    });
}

// Bubbles
let bubbles = [];
for(let i=0;i<50;i++){
    bubbles.push({x:Math.random()*width, y:height+Math.random()*height, radius:2+Math.random()*5, speed:0.3+Math.random()*0.7, alpha:0.2+Math.random()*0.4});
}

// Mouse
let mouse={x:null,y:null};
canvas.addEventListener('mousemove', e=>{mouse.x=e.offsetX;mouse.y=e.offsetY;});
canvas.addEventListener('mouseleave',()=>{mouse.x=null;mouse.y=null;});

// Draw Wave
function drawWave(w){
    ctx.beginPath();
    for(let x=0;x<width;x++){
        let y = height/2 + w.amplitude*Math.sin((x/w.wavelength + w.offset)*Math.PI*2);
        if(mouse.x!==null){ let dx=x-mouse.x; let inf=Math.exp(-(dx*dx)/20000)*20; y+=inf*Math.sin(Date.now()*0.002);}
        if(x===0) ctx.moveTo(x,y); else ctx.lineTo(x,y);
    }
    ctx.strokeStyle=w.color;
    ctx.lineWidth=2;
    ctx.stroke();
}

// Draw Bubbles
function drawBubbles(){
    bubbles.forEach(b=>{
        ctx.beginPath();
        ctx.arc(b.x,b.y,b.radius,0,Math.PI*2);
        ctx.fillStyle=`rgba(255,255,255,${b.alpha})`;
        ctx.fill();
        b.y-=b.speed;
        if(b.y+b.radius<0){b.y=height+b.radius; b.x=Math.random()*width;}
    });
}

// Animate
function animate(){
    ctx.clearRect(0,0,width,height);
    waves.forEach(w=>{w.offset+=w.speed; drawWave(w);});
    drawBubbles();
    requestAnimationFrame(animate);
}
animate();

// Responsive
window.addEventListener('resize',()=>{
    canvas.width=canvas.offsetWidth;
    canvas.height=canvas.offsetHeight;
    width=canvas.width; height=canvas.height;
});
</script>

</body>
</html>
