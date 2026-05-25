/* ============================================================
   EXCIGENT — Home Page JS (Three.js globe + events carousel)
   Loaded only on front-page.php via wp_enqueue_script
   ============================================================ */

/* ── Chip / orbit data ── */
const CHIP_DATA = {
  broadband: { defaultHint:'Fiber · Wireless · FTTH', activeHint:'Explore →', items:['Fiber Infrastructure','FTTH / FTTx Solutions','OSP Network Solutions','Broadband CPE','Fixed Wireless Access','Wireless Broadband Infrastructure','Fiber Installation Equipment'], pos:[[483,138],[451,75],[421,39],[39,39],[9,75],[-23,138],[-39,207]] },
  ict:       { defaultHint:'Cabling · Data Center · LAN', activeHint:'Explore →', items:['Structured Cabling','Optical LAN / POL','DAS','Intelligent Power Infrastructure','Network Connectivity','In-Building Wireless','Data Center Infrastructure'], pos:[[20,60],[-18,110],[-31,160],[-39,210],[-38,260],[68,450],[145,472]] },
  security:  { defaultHint:'Access · Surveillance · Biometrics', activeHint:'Explore →', items:['Access Control','Biometrics','Video Surveillance','Integrated Security Infrastructure','Intrusion Systems','Monitoring & Control Platforms'], pos:[[449,71],[480,129],[497,192],[492,268],[383,466],[225,500]] }
};
let current = null, chipEls = [], gen = 0;

function clearChips(cb) {
  const toRemove = [...chipEls]; chipEls = []; const myGen = ++gen;
  toRemove.forEach((el, i) => { setTimeout(() => { el.classList.remove('visible'); setTimeout(() => { if (el.parentNode) el.remove(); }, 380); }, i * 22); });
  document.querySelectorAll('.conn-line').forEach(l => l.classList.remove('lit'));
  Object.keys(CHIP_DATA).forEach(k => { const el = document.getElementById('hint-' + k); if (el) el.textContent = CHIP_DATA[k].defaultHint; });
  if (cb) setTimeout(() => { if (gen === myGen) cb(); }, toRemove.length ? 230 : 0);
}
function spawnChips(key) {
  const stage = document.getElementById('globeStage'); const d = CHIP_DATA[key];
  d.pos.forEach(([cx, cy], i) => { if (i >= d.items.length) return; const chip = document.createElement('span'); chip.className = 'orbit-chip'; chip.textContent = d.items[i]; chip.style.left = cx + 'px'; chip.style.top = cy + 'px'; stage.appendChild(chip); chipEls.push(chip); setTimeout(() => chip.classList.add('visible'), 30 + i * 60); });
  const line = document.getElementById('line-' + key); if (line) line.classList.add('lit');
  const hint = document.getElementById('hint-' + key); if (hint) hint.textContent = CHIP_DATA[key].activeHint;
}
function showService(key) { if (current === key) return; document.querySelectorAll('.svc').forEach(b => b.classList.remove('active')); current = null; clearChips(() => { current = key; document.getElementById('btn-' + key).classList.add('active'); spawnChips(key); }); }
function hideService() { document.querySelectorAll('.svc').forEach(b => b.classList.remove('active')); current = null; clearChips(); }

/* ── Three.js Globe ── */
(function () {
  const canvas = document.getElementById('globe-canvas');
  const stage  = document.getElementById('globeStage');
  if (!canvas || !stage || typeof THREE === 'undefined') return;

  const W = stage.offsetWidth, H = stage.offsetHeight;
  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setSize(W, H);
  renderer.outputColorSpace = THREE.SRGBColorSpace;

  const scene  = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(38, 1, 0.1, 100);
  camera.position.z = 2.75;

  const loader = new THREE.TextureLoader();
  loader.crossOrigin = 'anonymous';
  const BASE      = 'https://raw.githubusercontent.com/mrdoob/three.js/r128/examples/textures/planets/';
  const earthTex  = loader.load(BASE + 'earth_atmos_2048.jpg');
  const normTex   = loader.load(BASE + 'earth_normal_2048.jpg');
  const specTex   = loader.load(BASE + 'earth_specular_2048.jpg');
  const cloudTex  = loader.load(BASE + 'earth_clouds_1024.png');
  earthTex.colorSpace = THREE.SRGBColorSpace;

  const mat = new THREE.MeshPhongMaterial({
    map: earthTex, normalMap: normTex,
    normalScale: new THREE.Vector2(0.6, 0.6),
    specularMap: specTex,
    specular: new THREE.Color(0x223355),
    shininess: 20
  });
  const globe = new THREE.Mesh(new THREE.SphereGeometry(1, 72, 72), mat);
  scene.add(globe);

  const clouds = new THREE.Mesh(
    new THREE.SphereGeometry(1.008, 72, 72),
    new THREE.MeshPhongMaterial({ map: cloudTex, transparent: true, opacity: 0.4, depthWrite: false })
  );
  scene.add(clouds);

  const atmMat = new THREE.ShaderMaterial({
    uniforms: { col: { value: new THREE.Color(0x6baed6) } },
    vertexShader:   `varying vec3 vN; void main(){vN=normalize(normalMatrix*normal);gl_Position=projectionMatrix*modelViewMatrix*vec4(position,1.0);}`,
    fragmentShader: `uniform vec3 col; varying vec3 vN; void main(){float r=pow(1.0-abs(dot(vN,vec3(0.0,0.0,1.0))),4.0);gl_FragColor=vec4(col,r*0.45);}`,
    transparent: true, side: THREE.BackSide, depthWrite: false
  });
  scene.add(new THREE.Mesh(new THREE.SphereGeometry(1.14, 64, 64), atmMat));

  scene.add(new THREE.AmbientLight(0xd0e8f0, 0.9));
  const sun = new THREE.DirectionalLight(0xfffcf0, 2.2); sun.position.set(4, 2.5, 3); scene.add(sun);
  const fill = new THREE.DirectionalLight(0x2255aa, 0.35); fill.position.set(-3, -1, -2); scene.add(fill);

  let mx = 0, my = 0;
  window.addEventListener('mousemove', e => { mx = (e.clientX / window.innerWidth - 0.5) * 0.8; my = (e.clientY / window.innerHeight - 0.5) * 0.5; });

  (function tick() {
    requestAnimationFrame(tick);
    globe.rotation.y += 0.0014; clouds.rotation.y += 0.0017;
    globe.rotation.x  += (my * 0.5 - globe.rotation.x)  * 0.04;
    clouds.rotation.x += (my * 0.5 - clouds.rotation.x) * 0.04;
    renderer.render(scene, camera);
  })();

  window.addEventListener('resize', () => {
    const W = stage.offsetWidth, H = stage.offsetHeight;
    camera.aspect = W / H; camera.updateProjectionMatrix(); renderer.setSize(W, H);
  });
})();

/* ── Service hover ── */
(function () {
  const stage = document.getElementById('globeStage'); if (!stage) return;
  let leaveTimer = null;
  document.querySelectorAll('.svc').forEach(btn => {
    const key = btn.id.replace('btn-', '');
    btn.addEventListener('mouseenter', () => { clearTimeout(leaveTimer); showService(key); });
  });
  stage.addEventListener('mouseleave', () => { leaveTimer = setTimeout(hideService, 120); });
  stage.addEventListener('mouseenter', () => { clearTimeout(leaveTimer); });
})();

/* ── Hero dot spotlight ── */
(function () {
  const hero = document.querySelector('.hero'); if (!hero) return;
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  let pending = false, mx = 0, my = 0;
  function flush() { pending = false; hero.style.setProperty('--mx', mx + 'px'); hero.style.setProperty('--my', my + 'px'); }
  hero.addEventListener('mousemove', e => { const r = hero.getBoundingClientRect(); mx = e.clientX - r.left; my = e.clientY - r.top; if (!pending) { pending = true; requestAnimationFrame(flush); } }, { passive: true });
  hero.addEventListener('mouseleave', () => { hero.style.setProperty('--mx', '-300px'); hero.style.setProperty('--my', '-300px'); }, { passive: true });
})();

/* ── Animation cleanup ── */
(function () {
  function onAnimEnd(el) {
    if (!el) return;
    el.addEventListener('animationend', function h(e) {
      if (e.target !== el) return;
      el.removeEventListener('animationend', h);
      el.style.animation = 'none'; el.style.transform = ''; el.style.opacity = ''; el.style.filter = '';
    });
  }
  ['nav', '.globe-visual', '.globe-glow', '.conn-svg', '#btn-broadband', '#btn-ict', '#btn-security', '.headline h1', '.headline p', '.hero-btns'].forEach(s => onAnimEnd(document.querySelector(s)));
  const srch = document.getElementById('heroSearch');
  if (srch) srch.addEventListener('animationend', function h(e) { if (e.animationName === 'fadeIn') { srch.style.opacity = '1'; } });
})();

/* ── Hero search ── */
(function initHeroSearch() {
  const SEARCH_DATA = [
    { title:'Broadband',              cat:'Services', url:'#' },
    { title:'ICT Solutions',          cat:'Services', url:'#' },
    { title:'Security',               cat:'Services', url:'#' },
    { title:'Fiber Installation',     cat:'Services', url:'#' },
    { title:'Structured Cabling',     cat:'Services', url:'#' },
    { title:'Access Control',         cat:'Services', url:'#' },
    { title:'Channel Development',    cat:'Services',  url:'#' },
    { title:'Market Positioning',     cat:'Services',  url:'#' },
    { title:'Marketing & Visibility', cat:'Services',  url:'#' },
    { title:'About Excigent',         cat:'Company',   url:'#' },
    { title:'Geographic Reach',       cat:'Company',   url:'#' },
    { title:'Leadership Team',        cat:'Team',      url:'#' },
    { title:'News & Insights',        cat:'News',      url:'#' },
    { title:'Contact Us',             cat:'Contact',   url:'#' },
  ];

  const search    = document.getElementById('heroSearch'); if (!search) return;
  const input     = search.querySelector('.hero-search-input');
  const closeBtn  = search.querySelector('.hero-search-close');
  const globeWrap = document.querySelector('.globe-wrap');
  const anchor    = document.getElementById('btn-broadband');
  const hero      = document.querySelector('.hero');
  const results   = document.getElementById('heroSearchResults');
  const defaultHTML = results ? results.innerHTML : '';

  function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

  function renderResults(q) {
    if (!results) return;
    const trimmed = (q || '').trim();
    if (trimmed.length < 2) { results.innerHTML = defaultHTML; attachDefaultHandlers(); return; }
    const ql   = trimmed.toLowerCase();
    const hits = SEARCH_DATA.filter(d => d.title.toLowerCase().includes(ql) || d.cat.toLowerCase().includes(ql)).slice(0, 7);
    if (!hits.length) { results.innerHTML = `<div class="hero-search-empty">No results for "<strong style="color:var(--navy)">${esc(trimmed)}</strong>"</div>`; return; }
    results.innerHTML = hits.map(d => `
      <button type="button" class="hero-search-item" data-url="${d.url}">
        <span class="hero-search-item-icon"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg></span>
        <span class="hero-search-item-text"><span class="hero-search-item-title">${esc(d.title)}</span><span class="hero-search-item-cat">${esc(d.cat)}</span></span>
        <span class="hero-search-item-arrow"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
      </button>`).join('') +
      `<div class="hero-search-divider"></div>
      <button type="button" class="hero-search-item" data-url="/?s=${encodeURIComponent(trimmed)}" style="color:var(--blue)">
        <span class="hero-search-item-icon"><svg viewBox="0 0 24 24"><polyline points="3 17 9 11 13 15 21 7"/></svg></span>
        <span class="hero-search-item-text"><span class="hero-search-item-title">See all results for "<strong>${esc(trimmed)}</strong>"</span></span>
        <span class="hero-search-item-arrow"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
      </button>`;
    results.querySelectorAll('.hero-search-item[data-url]').forEach(item => { item.addEventListener('click', () => { window.location.href = item.dataset.url; }); });
  }

  function attachDefaultHandlers() {
    if (!results) return;
    results.querySelectorAll('.hero-search-item[data-q]').forEach(item => {
      item.addEventListener('click', () => { const q = item.dataset.q; if (input) input.value = q; renderResults(q); });
    });
  }
  attachDefaultHandlers();

  function alignToAnchor() {
    if (window.innerWidth <= 768) { search.style.top = ''; if (results) results.style.top = ''; return; }
    if (!anchor || !hero) return;
    const heroRect   = hero.getBoundingClientRect();
    const anchorRect = anchor.getBoundingClientRect();
    const centerY    = (anchorRect.top + anchorRect.bottom) / 2 - heroRect.top;
    search.style.top = Math.max(120, centerY) + 'px';
    positionResults();
  }
  function positionResults() {
    if (!results || window.innerWidth <= 768) return;
    const t = parseFloat(search.style.top || '0'); if (!t) return;
    results.style.top = (t + search.offsetHeight / 2 + 12) + 'px';
  }
  alignToAnchor();
  window.addEventListener('resize', alignToAnchor);
  setTimeout(alignToAnchor, 5600);

  function open() {
    if (search.classList.contains('open')) return;
    search.style.animation = ''; // clear inline so .open CSS animation:none takes effect
    search.classList.add('open');
    if (globeWrap && window.innerWidth > 768) globeWrap.classList.add('shifted');
    positionResults();
    if (results) results.classList.add('visible');
    setTimeout(() => input && input.focus(), 220);
  }
  function collapse() {
    if (!search.classList.contains('open')) return;
    search.classList.remove('open');
    // Prevent fadeIn from re-firing — only run the pulse animation
    search.style.animation = 'heroSearchPulse 2.6s ease-in-out 0s infinite';
    if (globeWrap) globeWrap.classList.remove('shifted');
    if (results) results.classList.remove('visible');
    if (input) { input.value = ''; input.blur(); renderResults(''); }
  }
  search.addEventListener('click', e => { if (search.classList.contains('open')) return; if (e.target === closeBtn || closeBtn.contains(e.target)) return; open(); });
  closeBtn.addEventListener('click', e => { e.stopPropagation(); collapse(); });
  input.addEventListener('click', e => e.stopPropagation());
  input.addEventListener('input', () => renderResults(input.value));
  input.addEventListener('keydown', e => { if (e.key === 'Enter') { e.preventDefault(); const q = (input.value || '').trim(); if (q) window.location.href = '/?s=' + encodeURIComponent(q); } });
  if (results) results.addEventListener('click', e => e.stopPropagation());
  document.addEventListener('keydown', e => { if (e.key === 'Escape') collapse(); });
  document.addEventListener('click', e => { if (!search.classList.contains('open')) return; if (search.contains(e.target)) return; if (results && results.contains(e.target)) return; collapse(); });
})();

/* ── Events carousel ── */
(function () {
  const track = document.getElementById('eventsTrack'); if (!track) return;
  const cards = track.querySelectorAll('.ev-card'); if (!cards.length) return;
  let idx = 0;
  function getGap()      { return parseFloat(getComputedStyle(track).columnGap) || 22; }
  function visibleCount(){ return window.innerWidth <= 600 ? 1 : window.innerWidth <= 980 ? 2 : 3; }
  function maxIdx()      { return Math.max(0, cards.length - visibleCount()); }
  function slide()       { const cardW = cards[0].offsetWidth + getGap(); track.style.transform = `translateX(-${idx * cardW}px)`; }
  document.getElementById('evNext').addEventListener('click', function(){ idx = idx >= maxIdx() ? 0 : idx + 1; slide(); });
  document.getElementById('evPrev').addEventListener('click', function(){ idx = idx <= 0 ? maxIdx() : idx - 1; slide(); });
  window.addEventListener('resize', function(){ idx = Math.min(idx, maxIdx()); slide(); });
})();
