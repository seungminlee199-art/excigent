<?php
/**
 * Front Page — Excigent Tech Partners
 * WordPress template for the home page (index.html)
 * All dynamic content driven by ACF fields on this page.
 */
get_header();

/* ── ACF helpers ── */
function _ef( $k, $fb = '' ) { return function_exists( 'get_field' ) ? ( get_field($k) ?: $fb ) : $fb; }
?>

<!-- ══ HERO ══ -->
<style>
/* ── HERO ── */
.hero{min-height:100vh;padding-top:64px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;background:linear-gradient(180deg,#DCE7F2 0%,#E8EFF6 18%,#F4F7FB 45%,#FFFFFF 100%)}
.hero::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle,rgba(0,97,179,.22) 1px,transparent 1px);background-size:32px 32px;pointer-events:none}
.hero::after{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 55% at 50% 60%,rgba(255,255,255,0) 0%,rgba(255,255,255,.7) 100%);pointer-events:none}
.hero-dots-dark{position:absolute;inset:0;pointer-events:none;z-index:1;background-image:radial-gradient(circle,rgba(0,69,105,.75) 1px,transparent 1px);background-size:32px 32px;background-position:0 0;opacity:0;transition:opacity .35s ease;-webkit-mask:radial-gradient(circle 180px at var(--mx,-300px) var(--my,-300px),rgba(0,0,0,1) 0%,rgba(0,0,0,0) 75%);mask:radial-gradient(circle 180px at var(--mx,-300px) var(--my,-300px),rgba(0,0,0,1) 0%,rgba(0,0,0,0) 75%)}
.hero:hover .hero-dots-dark{opacity:1}
.hero-inner{position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;width:100%;max-width:1080px;padding:2rem 2rem 4rem}
.eyebrow{display:inline-flex;align-items:center;gap:.45rem;font-size:.67rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:var(--blue);padding:.3rem .85rem;border:1px solid rgba(0,97,179,.2);border-radius:30px;background:rgba(0,97,179,.04);margin-bottom:1.4rem;will-change:transform,opacity;animation:fadeUp .6s cubic-bezier(.22,1,.36,1) 4.7s both}
.eyebrow-dot{width:6px;height:6px;border-radius:50%;background:var(--blue);opacity:.7}
.globe-wrap{position:relative;display:flex;flex-direction:column;align-items:center;transform-origin:center center;transition:transform .55s cubic-bezier(.22,1,.36,1)}
.globe-wrap.shifted{transform:translateX(-200px) scale(.76)}
.globe-stage{position:relative;width:460px;height:460px;overflow:visible}
.globe-glow{position:absolute;top:50%;left:50%;width:540px;height:540px;border-radius:50%;background:radial-gradient(circle,rgba(0,97,179,.10) 0%,rgba(0,69,105,.05) 45%,transparent 70%);pointer-events:none;z-index:0;animation:glowIn 2.4s cubic-bezier(.22,1,.36,1) .6s both;transform:translate(-50%,-50%)}
.globe-visual{position:absolute;inset:0;z-index:1;will-change:transform,opacity,filter;animation:globeArrive 2.8s cubic-bezier(.22,1,.36,1) .2s both}
#globe-canvas{position:absolute;inset:0;width:100%!important;height:100%!important;border-radius:50%;box-shadow:0 6px 16px rgba(0,69,105,.14),0 22px 50px -12px rgba(0,69,105,.22),0 40px 90px -22px rgba(0,97,179,.22)}
.globe-shadow{position:absolute;bottom:-14px;left:50%;transform:translateX(-50%);width:300px;height:28px;border-radius:50%;background:radial-gradient(ellipse at center,rgba(0,69,105,.12) 0%,transparent 70%);pointer-events:none}
.conn-svg{position:absolute;inset:-60px;width:calc(100% + 120px);height:calc(100% + 120px);pointer-events:none;z-index:5;overflow:visible;animation:fadeIn .6s ease-out 4.4s both}
.conn-line{fill:none;stroke:rgba(0,69,105,.13);stroke-width:1;stroke-dasharray:4 6;animation:march 3.5s linear infinite;transition:stroke .35s,stroke-width .35s}
.conn-line.lit{stroke:rgba(0,97,179,.5);stroke-width:1.5;stroke-dasharray:5 4}
@keyframes march{to{stroke-dashoffset:-40}}
.svc{position:absolute;display:flex;align-items:center;gap:.5rem;padding:.52rem 1rem .52rem .6rem;background:#fff;border:1px solid rgba(0,69,105,.12);border-radius:50px;cursor:pointer;color:var(--navy);box-shadow:0 1px 1px rgba(0,69,105,.04),0 2px 4px rgba(0,69,105,.06),0 8px 16px -4px rgba(0,69,105,.10),0 20px 36px -12px rgba(0,69,105,.18);transition:all .22s cubic-bezier(.34,1.56,.64,1);z-index:10;white-space:nowrap;user-select:none}
.svc:hover,.svc.active{background:linear-gradient(135deg,var(--blue) 0%,var(--mid) 100%);border-color:rgba(255,255,255,.22);color:#fff;box-shadow:0 1px 2px rgba(0,69,105,.10),0 4px 10px rgba(0,69,105,.14),0 14px 26px -6px rgba(0,69,105,.22),0 26px 44px -12px rgba(0,97,179,.32);transform:scale(1.04)}
.svc.top{top:-26px;left:50%;transform:translateX(-50%)}.svc.top:hover{transform:translateX(-50%) scale(1.04)}.svc.top.active{transform:translateX(-50%) scale(1.04)}
.svc.bl{bottom:52px;left:-96px}.svc.br{bottom:52px;right:-96px}
.svc.active::after{content:'';position:absolute;inset:-6px;border-radius:50px;border:1.5px solid rgba(255,255,255,.55);animation:btnRing 1.8s ease-out infinite}
@keyframes btnRing{0%{opacity:1;transform:scale(1)}100%{opacity:0;transform:scale(1.18)}}
.svc::before{content:'';position:absolute;inset:0;border-radius:50px;pointer-events:none;box-shadow:0 0 0 0 rgba(0,97,179,0);animation:svcPulse 2.8s ease-out infinite;animation-delay:var(--svc-pulse-delay,5.2s)}
.svc:hover::before,.svc.active::before{animation:none}
@keyframes svcPulse{0%{box-shadow:0 0 0 0 rgba(0,97,179,.55)}70%{box-shadow:0 0 0 14px rgba(0,97,179,0)}100%{box-shadow:0 0 0 0 rgba(0,97,179,0)}}
#btn-broadband{--svc-pulse-delay:5.2s;will-change:transform,opacity;animation:pillDown .6s cubic-bezier(.34,1.56,.64,1) 3.9s both}
#btn-ict{--svc-pulse-delay:5.5s;will-change:transform,opacity;animation:pillFromLeft .6s cubic-bezier(.34,1.56,.64,1) 4.1s both}
#btn-security{--svc-pulse-delay:5.8s;will-change:transform,opacity;animation:pillFromRight .6s cubic-bezier(.34,1.56,.64,1) 4.3s both}
.svc-ico{width:32px;height:32px;border-radius:50%;background:rgba(0,69,105,.06);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .22s}
.svc:hover .svc-ico,.svc.active .svc-ico{background:rgba(255,255,255,.22)}
.svc-ico svg{width:14px;height:14px;stroke:var(--navy);transition:stroke .22s}
.svc:hover .svc-ico svg,.svc.active .svc-ico svg{stroke:#fff}
.svc-body{display:flex;flex-direction:column;line-height:1;gap:3px}
.svc-name{font-size:.78rem;font-weight:700;color:var(--navy);letter-spacing:.02em;transition:color .22s}
.svc:hover .svc-name,.svc.active .svc-name{color:#fff}
.svc-hint{font-size:.6rem;color:var(--muted);font-weight:400;transition:color .22s}
.svc:hover .svc-hint,.svc.active .svc-hint{color:rgba(255,255,255,.85)}
.orbit-chip{position:absolute;font-size:.69rem;font-weight:500;color:#fff;padding:.28rem .72rem;background:linear-gradient(135deg,rgba(0,97,179,.96) 0%,rgba(35,99,160,.96) 100%);border:1px solid rgba(255,255,255,.18);border-radius:20px;box-shadow:0 1px 1px rgba(0,69,105,.06),0 2px 6px rgba(0,69,105,.10),0 6px 14px -4px rgba(0,69,105,.14),0 18px 30px -10px rgba(0,97,179,.28);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);white-space:nowrap;pointer-events:none;z-index:20;transform:translate(-50%,-50%) scale(0);opacity:0;transition:transform .42s cubic-bezier(.34,1.56,.64,1),opacity .28s ease;letter-spacing:.01em}
.orbit-chip.visible{transform:translate(-50%,-50%) scale(1);opacity:1}
.headline{text-align:center;max-width:660px;margin-top:3.2rem}
.headline h1{font-size:clamp(2.1rem,4vw,3.1rem);font-weight:300;line-height:1.16;letter-spacing:-.025em;color:var(--navy);margin-bottom:1rem;will-change:transform,opacity;animation:fadeUp .7s cubic-bezier(.22,1,.36,1) 4.9s both}
.headline h1 strong{font-weight:700}
.headline p{font-size:.98rem;color:var(--muted);line-height:1.72;font-weight:400;max-width:520px;margin:0 auto 2.2rem;will-change:transform,opacity;animation:fadeUp .7s cubic-bezier(.22,1,.36,1) 5.05s both}
.hero-btns{display:flex;gap:.75rem;justify-content:center;will-change:transform,opacity;animation:fadeUp .7s cubic-bezier(.22,1,.36,1) 5.2s both}
.hero-btn-fill{font-family:inherit;font-size:.82rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;padding:.75rem 1.8rem;background:var(--navy);color:#fff;border:none;border-radius:5px;cursor:pointer;text-decoration:none;transition:background .2s,transform .15s}
.hero-btn-fill:hover{background:var(--blue);transform:translateY(-1px)}
.hero-btn-ghost{font-family:inherit;font-size:.82rem;font-weight:500;letter-spacing:.03em;padding:.75rem 1.8rem;background:transparent;color:var(--navy);border:1px solid rgba(0,69,105,.22);border-radius:5px;cursor:pointer;text-decoration:none;transition:border-color .2s,background .2s}
.hero-btn-ghost:hover{border-color:var(--navy);background:rgba(0,69,105,.03)}
.scroll-hint{position:absolute;bottom:1.8rem;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:6px;opacity:.25;pointer-events:none;animation:scrollHintIn .6s ease-out 5.7s both}
.scroll-hint span{font-size:.58rem;letter-spacing:.2em;text-transform:uppercase;color:var(--navy)}
.scroll-mouse{width:18px;height:28px;border:1.5px solid var(--navy);border-radius:9px;position:relative}
.scroll-mouse::after{content:'';position:absolute;top:5px;left:50%;transform:translateX(-50%);width:2.5px;height:5px;background:var(--navy);border-radius:2px;animation:sm 1.8s ease-in-out infinite}
@keyframes sm{0%,100%{opacity:1;top:5px}50%{opacity:0;top:12px}}
@keyframes navSlideDown{from{transform:translateY(-100%);opacity:0}to{transform:translateY(0);opacity:1}}
@keyframes globeArrive{0%{transform:perspective(1200px) scale(.03) translateY(-50px) rotateY(28deg) rotateX(8deg);filter:blur(14px) brightness(.7);opacity:0}25%{opacity:1;filter:blur(10px) brightness(.8)}70%{filter:blur(1.5px) brightness(1)}100%{transform:perspective(1200px) scale(1) translateY(0) rotateY(0) rotateX(0);filter:blur(0) brightness(1);opacity:1}}
@keyframes glowIn{from{opacity:0}to{opacity:1}}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
@keyframes pillDown{from{transform:translateX(-50%) translateY(-80px);opacity:0}to{transform:translateX(-50%) translateY(0);opacity:1}}
@keyframes pillFromLeft{from{transform:translateX(-100px) translateY(40px);opacity:0}to{transform:translateX(0) translateY(0);opacity:1}}
@keyframes pillFromRight{from{transform:translateX(100px) translateY(40px);opacity:0}to{transform:translateX(0) translateY(0);opacity:1}}
@keyframes fadeUp{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}
@keyframes scrollHintIn{from{opacity:0}to{opacity:.25}}
nav{animation:navSlideDown .8s cubic-bezier(.22,1,.36,1) 3.0s both}
@media (prefers-reduced-motion:reduce){nav,.globe-visual,.globe-glow,.conn-svg,.eyebrow,.headline h1,.headline p,.hero-btns{animation:none!important;opacity:1!important;filter:none!important;transform:none!important}#btn-broadband{animation:none!important;opacity:1!important;transform:translateX(-50%)!important}#btn-ict,#btn-security{animation:none!important;opacity:1!important}}
@media (max-width:768px){.globe-stage{width:320px;height:320px}.globe-glow{width:380px;height:380px}.svc.bl{left:-60px}.svc.br{right:-60px}}
/* Events carousel */
.events-carousel{position:relative;overflow:hidden}
.events-track{display:flex;gap:1.4rem;transition:transform .45s cubic-bezier(.22,1,.36,1)}
.ev-card{flex:0 0 calc(33.333% - .94rem);background:#fff;border:1px solid rgba(0,69,105,.10);border-radius:18px;overflow:hidden;transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s ease,border-color .35s ease}
.ev-card:hover{transform:translateY(-5px);border-color:rgba(0,97,179,.25);box-shadow:0 18px 48px -20px rgba(0,69,105,.28)}
.ev-card-top{padding:1.4rem 1.5rem;position:relative;overflow:hidden}
.ev-card-top::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,.08) 1px,transparent 1px);background-size:18px 18px}
.ev-badge{display:inline-flex;flex-direction:column;align-items:center;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.20);border-radius:12px;padding:.5rem 1rem;position:relative;z-index:2}
.ev-month{font-size:.6rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(255,255,255,.7)}
.ev-day{font-size:1.55rem;font-weight:700;color:#fff;line-height:1}
.ev-card-body{padding:1.3rem 1.5rem 1.5rem}
.ev-type{font-size:.62rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--blue);display:block;margin-bottom:.4rem}
.ev-name{font-size:1rem;font-weight:600;color:var(--navy);margin-bottom:.5rem;line-height:1.3}
.ev-loc{display:flex;align-items:center;gap:.4rem;font-size:.82rem;color:var(--muted);margin-bottom:.9rem}
.ev-loc svg{width:12px;height:12px;stroke:var(--blue);flex-shrink:0}
.ev-tag{display:inline-block;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:.25rem .65rem;border-radius:30px;background:rgba(0,97,179,.08);color:var(--navy)}
.carousel-nav{display:flex;gap:.6rem;margin-top:1.5rem}
.carousel-btn{width:42px;height:42px;border-radius:50%;border:1px solid rgba(0,69,105,.15);background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,border-color .2s}
.carousel-btn svg{width:18px;height:18px}
.carousel-btn:hover{background:var(--navy);border-color:var(--navy)}
.carousel-btn:hover svg{stroke:#fff}
@media (max-width:980px){.ev-card{flex:0 0 calc(50% - .7rem)}}
@media (max-width:600px){.ev-card{flex:0 0 100%}}
/* Hero search */
.hero-search{position:absolute;top:40%;right:3.5rem;transform:translateY(-50%);z-index:40;height:60px;width:60px;display:flex;align-items:center;padding:0;background:rgba(255,255,255,.85);border:1px solid rgba(0,69,105,.14);border-radius:34px;box-shadow:0 1px 3px rgba(0,69,105,.06),0 10px 28px -10px rgba(0,69,105,.28);backdrop-filter:saturate(180%) blur(14px);-webkit-backdrop-filter:saturate(180%) blur(14px);cursor:pointer;overflow:hidden;opacity:0;transition:width .55s cubic-bezier(.22,1,.36,1),left .55s cubic-bezier(.22,1,.36,1),background .3s ease,box-shadow .3s ease,border-color .3s ease;animation:fadeIn .6s ease-out 4.9s both,heroSearchPulse 2.6s ease-in-out 5.6s infinite}
@keyframes heroSearchPulse{0%,100%{box-shadow:0 1px 3px rgba(0,69,105,.06),0 10px 28px -10px rgba(0,69,105,.28),0 0 0 0 rgba(0,97,179,.55)}60%{box-shadow:0 1px 3px rgba(0,69,105,.06),0 10px 28px -10px rgba(0,69,105,.28),0 0 0 14px rgba(0,97,179,0)}}
.hero-search:hover:not(.open){background:rgba(255,255,255,.95);border-color:rgba(0,97,179,.4)}
.hero-search-icon{width:60px;height:60px;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--navy);transition:transform .3s cubic-bezier(.22,1,.36,1)}
.hero-search:hover:not(.open) .hero-search-icon{transform:scale(1.08)}
.hero-search-icon svg{width:22px;height:22px}
.hero-search-input{flex:1;min-width:0;height:100%;border:none;outline:none;background:transparent;font-family:inherit;font-size:.95rem;color:var(--navy);opacity:0;pointer-events:none;padding:0 .5rem;transition:opacity .25s ease .2s}
.hero-search-input::placeholder{color:var(--muted)}
.hero-search-close{flex-shrink:0;width:40px;height:40px;margin-right:8px;border:none;background:transparent;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--muted);cursor:pointer;opacity:0;pointer-events:none;transition:opacity .2s ease .2s,background .18s ease,color .18s ease}
.hero-search-close:hover{background:rgba(0,69,105,.08);color:var(--navy)}
.hero-search-close svg{width:18px;height:18px}
.hero-search.open{width:440px;cursor:text;opacity:1;background:rgba(255,255,255,.97);border-color:rgba(0,97,179,.35);box-shadow:0 2px 6px rgba(0,69,105,.08),0 18px 40px -12px rgba(0,69,105,.35);animation:none}
.hero-search.open .hero-search-input{opacity:1;pointer-events:auto}
.hero-search.open .hero-search-close{opacity:1;pointer-events:auto}
.hero-search-results{position:absolute;right:3.5rem;width:440px;z-index:39;background:rgba(255,255,255,.98);border:1px solid rgba(0,69,105,.10);border-radius:18px;padding:10px 8px 12px;box-shadow:0 1px 2px rgba(0,69,105,.06),0 8px 20px -4px rgba(0,69,105,.14),0 28px 60px -16px rgba(0,69,105,.24);backdrop-filter:saturate(180%) blur(14px);-webkit-backdrop-filter:saturate(180%) blur(14px);opacity:0;transform:translateY(-6px);pointer-events:none;transition:opacity .22s ease,transform .22s ease;max-height:60vh;overflow-y:auto}
.hero-search-results.visible{opacity:1;transform:translateY(0);pointer-events:auto;transition:opacity .32s ease .22s,transform .32s ease .22s}
.hero-search-section{display:flex;align-items:center;gap:6px;padding:8px 14px 6px;font-size:.62rem;font-weight:600;color:var(--muted);letter-spacing:.14em;text-transform:uppercase}
.hero-search-item{display:flex;align-items:center;gap:12px;width:100%;padding:9px 12px;border:none;background:transparent;border-radius:12px;font-family:inherit;font-size:.86rem;color:var(--navy);text-align:left;cursor:pointer;transition:background .18s ease,color .18s ease}
.hero-search-item:hover{background:rgba(0,97,179,.08);color:var(--blue)}
.hero-search-item-icon{width:30px;height:30px;border-radius:50%;background:rgba(0,69,105,.06);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--soft);transition:background .18s ease,color .18s ease}
.hero-search-item:hover .hero-search-item-icon{background:rgba(0,97,179,.14);color:var(--blue)}
.hero-search-item-icon svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.hero-search-item-text{flex:1;display:flex;flex-direction:column;gap:1px}
.hero-search-item-title{display:block;font-weight:500}
.hero-search-item-cat{display:block;font-size:.72rem;color:var(--muted)}
.hero-search-item-arrow{display:flex;align-items:center;color:var(--muted);opacity:0;transform:translateX(-4px);transition:opacity .18s ease,transform .18s ease}
.hero-search-item:hover .hero-search-item-arrow{opacity:.8;transform:translateX(0)}
.hero-search-divider{height:1px;background:rgba(0,69,105,.07);margin:6px 8px}
.hero-search-empty{padding:1.5rem;text-align:center;color:var(--muted);font-size:.9rem}
@media (max-width:1100px){.hero-search{right:2rem}.hero-search.open{width:340px}.hero-search-results{right:2rem;width:340px}.globe-wrap.shifted{transform:translateX(-160px) scale(.79)}}
@media (max-width:960px){.hero-search{right:1.2rem}.hero-search.open{width:290px}.hero-search-results{right:1.2rem;width:290px}.globe-wrap.shifted{transform:translateX(-120px) scale(.83)}}
@media (max-width:768px){.hero-search{top:80px;right:1rem;transform:none;width:44px;height:44px;border-radius:26px}.hero-search-icon{width:44px;height:44px}.hero-search-icon svg{width:18px;height:18px}.hero-search.open{width:calc(100vw - 2rem);left:1rem;right:1rem}.hero-search-results{right:1rem;left:1rem;width:auto;top:136px!important}.globe-wrap.shifted{transform:none!important}}
</style>

<section class="hero">
  <div class="hero-dots-dark" aria-hidden="true"></div>

  <!-- Hero Search -->
  <div class="hero-search" id="heroSearch" role="search">
    <span class="hero-search-icon" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg>
    </span>
    <input type="text" class="hero-search-input" placeholder="Search Excigent…" aria-label="Search" />
    <button type="button" class="hero-search-close" aria-label="Close search">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>

  <div class="hero-search-results" id="heroSearchResults" aria-hidden="true">
    <div class="hero-search-section">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/></svg>
      Recent
    </div>
    <button type="button" class="hero-search-item" data-q="Fiber Installation">
      <span class="hero-search-item-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/></svg></span>
      <span class="hero-search-item-text">Fiber Installation</span>
      <span class="hero-search-item-arrow"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
    </button>
    <button type="button" class="hero-search-item" data-q="Data Center Solutions">
      <span class="hero-search-item-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/></svg></span>
      <span class="hero-search-item-text">Data Center Solutions</span>
      <span class="hero-search-item-arrow"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
    </button>
  </div>

  <div class="hero-inner">
    <div class="globe-wrap">
      <div class="globe-stage" id="globeStage">
        <div class="globe-glow"></div>
        <div class="globe-visual">
          <canvas id="globe-canvas"></canvas>
          <div class="globe-shadow"></div>
        </div>
        <svg class="conn-svg" viewBox="0 0 580 580" fill="none">
          <path class="conn-line" id="line-broadband" d="M290 44 L290 148"/>
          <path class="conn-line" id="line-ict"       d="M78 435 L168 338"/>
          <path class="conn-line" id="line-security"  d="M502 435 L410 338"/>
        </svg>
        <!-- Broadband pill -->
        <div class="svc top" id="btn-broadband">
          <div class="svc-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1.5 8.5s5-4 10.5-4 10.5 4 10.5 4"/><path d="M5 12s3.5-2.5 7-2.5 7 2.5 7 2.5"/><path d="M8.5 15.5s1.75-1.5 3.5-1.5 3.5 1.5 3.5 1.5"/><circle cx="12" cy="19" r="1" fill="currentColor" stroke="none"/></svg></div>
          <div class="svc-body"><span class="svc-name">Broadband</span><span class="svc-hint" id="hint-broadband">Fiber · Wireless · FTTH</span></div>
        </div>
        <!-- ICT pill -->
        <div class="svc bl" id="btn-ict">
          <div class="svc-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="7" height="7" rx="1"/><rect x="15" y="3" width="7" height="7" rx="1"/><rect x="2" y="14" width="7" height="7" rx="1"/><rect x="15" y="14" width="7" height="7" rx="1"/><line x1="9" y1="6.5" x2="15" y2="6.5"/><line x1="9" y1="17.5" x2="15" y2="17.5"/><line x1="12" y1="10" x2="12" y2="14"/></svg></div>
          <div class="svc-body"><span class="svc-name">ICT</span><span class="svc-hint" id="hint-ict">Cabling · Data Center · LAN</span></div>
        </div>
        <!-- Security pill -->
        <div class="svc br" id="btn-security">
          <div class="svc-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L3 6.5V12c0 5 4 9 9 10 5-1 9-5 9-10V6.5L12 2z"/><polyline points="9 12 11 14 15 10"/></svg></div>
          <div class="svc-body"><span class="svc-name">Security</span><span class="svc-hint" id="hint-security">Access · Surveillance · Biometrics</span></div>
        </div>
      </div>
    </div>

    <div class="headline">
      <h1><?php echo wp_kses_post( _ef( 'hero_heading', 'Where <strong>Broadband, ICT</strong> &amp; Security Converge' ) ); ?></h1>
      <p><?php echo esc_html( _ef( 'hero_subtext', 'Helping innovative companies build channels, strengthen market presence, and accelerate revenue growth across North America, Latin America & the Caribbean.' ) ); ?></p>
      <div class="hero-btns">
        <?php
        $hero_btn1 = function_exists('get_field') ? get_field('hero_btn_primary') : null;
        $hero_btn2 = function_exists('get_field') ? get_field('hero_btn_secondary') : null;
        $btn1_url   = $hero_btn1 ? esc_url($hero_btn1['url']) : esc_url(home_url('/services/'));
        $btn1_label = $hero_btn1 ? esc_html($hero_btn1['title']) : 'Explore Our Services';
        $btn2_url   = $hero_btn2 ? esc_url($hero_btn2['url']) : esc_url(home_url('/team/'));
        $btn2_label = $hero_btn2 ? esc_html($hero_btn2['title']) : 'Meet the Team';
        ?>
        <a href="<?php echo $btn1_url; ?>" class="hero-btn-fill"><?php echo $btn1_label; ?></a>
        <a href="<?php echo $btn2_url; ?>" class="hero-btn-ghost"><?php echo $btn2_label; ?></a>
      </div>
    </div>
  </div>

  <div class="scroll-hint" aria-hidden="true">
    <span>Scroll</span>
    <div class="scroll-mouse"></div>
  </div>
</section>

<!-- ══ UPCOMING EVENTS CAROUSEL ══ -->
<?php
$events_heading = _ef('events_section_heading', 'Upcoming <strong>Events</strong>');
$events_link    = function_exists('get_field') ? get_field('events_view_all_link') : null;
$events_url     = $events_link ? esc_url($events_link['url']) : esc_url(home_url('/media/#events'));

// Try ACF repeater first, else fall back to Events CPT
$acf_events = function_exists('get_field') ? get_field('events_carousel') : null;
?>
<section class="section light" id="events" style="padding-top:4rem;padding-bottom:4rem;">
  <div class="section-inner">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
      <div>
        <span class="section-eyebrow reveal" style="--d:0s">Where to Find Us</span>
        <h2 class="section-title reveal" style="--d:0.05s;margin-bottom:0"><?php echo wp_kses_post($events_heading); ?></h2>
      </div>
      <a href="<?php echo $events_url; ?>" class="btn-ghost navy reveal" style="--d:0.1s;flex-shrink:0">View All Events</a>
    </div>
    <div class="events-carousel">
      <div class="events-track" id="eventsTrack">
        <?php if ($acf_events) :
          foreach ($acf_events as $ev) :
            $month  = esc_html($ev['month'] ?? '');
            $day    = esc_html($ev['day'] ?? '');
            $type   = esc_html($ev['type'] ?? 'Trade Show');
            $name   = esc_html($ev['name'] ?? '');
            $loc    = esc_html($ev['location'] ?? '');
            $tag    = esc_html($ev['tag'] ?? '');
            $bg     = esc_attr($ev['gradient'] ?? 'linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)');
        ?>
        <div class="ev-card">
          <div class="ev-card-top" style="background:<?php echo $bg; ?>">
            <div class="ev-badge"><span class="ev-month"><?php echo $month; ?></span><span class="ev-day"><?php echo $day; ?></span></div>
          </div>
          <div class="ev-card-body">
            <span class="ev-type"><?php echo $type; ?></span>
            <h4 class="ev-name"><?php echo $name; ?></h4>
            <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><?php echo $loc; ?></p>
            <span class="ev-tag"><?php echo $tag; ?></span>
          </div>
        </div>
        <?php endforeach;
        else : /* Fallback: query Events CPT */
          $ev_query = new WP_Query(['post_type'=>'event','posts_per_page'=>4,'orderby'=>'meta_value','meta_key'=>'event_date','order'=>'ASC']);
          if ($ev_query->have_posts()) :
            while ($ev_query->have_posts()) : $ev_query->the_post();
              $ev_date = function_exists('get_field') ? get_field('event_date') : '';
              $ev_loc  = function_exists('get_field') ? esc_html(get_field('event_location')) : '';
              $ev_type = function_exists('get_field') ? esc_html(get_field('event_type')) : 'Trade Show';
              $ev_tag  = function_exists('get_field') ? esc_html(get_field('event_tag')) : '';
              $month   = $ev_date ? date('M', strtotime($ev_date)) : '';
              $day     = $ev_date ? date('d', strtotime($ev_date)) : '';
        ?>
        <div class="ev-card">
          <div class="ev-card-top" style="background:linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)">
            <div class="ev-badge"><span class="ev-month"><?php echo $month; ?></span><span class="ev-day"><?php echo $day; ?></span></div>
          </div>
          <div class="ev-card-body">
            <span class="ev-type"><?php echo $ev_type; ?></span>
            <h4 class="ev-name"><?php the_title(); ?></h4>
            <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><?php echo $ev_loc; ?></p>
            <?php if ($ev_tag) : ?><span class="ev-tag"><?php echo $ev_tag; ?></span><?php endif; ?>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata();
          else : /* Static fallback */ ?>
        <div class="ev-card">
          <div class="ev-card-top" style="background:linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)">
            <div class="ev-badge"><span class="ev-month">Jun</span><span class="ev-day">14</span></div>
          </div>
          <div class="ev-card-body">
            <span class="ev-type">Trade Show</span>
            <h4 class="ev-name">InfoComm 2026</h4>
            <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Las Vegas, NV</p>
            <span class="ev-tag">ICT &amp; AV Technology</span>
          </div>
        </div>
        <div class="ev-card">
          <div class="ev-card-top" style="background:linear-gradient(135deg,#0A2F45,#0061B3 80%)">
            <div class="ev-badge"><span class="ev-month">Sep</span><span class="ev-day">04</span></div>
          </div>
          <div class="ev-card-body">
            <span class="ev-type">Trade Show</span>
            <h4 class="ev-name">CEDIA Expo 2026</h4>
            <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Denver, CO</p>
            <span class="ev-tag">Residential Technology</span>
          </div>
        </div>
        <div class="ev-card">
          <div class="ev-card-top" style="background:linear-gradient(135deg,#004569,#0061B3 80%)">
            <div class="ev-badge"><span class="ev-month">Oct</span><span class="ev-day">19</span></div>
          </div>
          <div class="ev-card-body">
            <span class="ev-type">International Expo</span>
            <h4 class="ev-name">Futurecom 2026</h4>
            <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>São Paulo, Brazil</p>
            <span class="ev-tag">Broadband &amp; Telecom</span>
          </div>
        </div>
        <div class="ev-card">
          <div class="ev-card-top" style="background:linear-gradient(135deg,#061F2E,#0061B3 90%)">
            <div class="ev-badge"><span class="ev-month">Nov</span><span class="ev-day">09</span></div>
          </div>
          <div class="ev-card-body">
            <span class="ev-type">Security Expo</span>
            <h4 class="ev-name">GSX 2026</h4>
            <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Houston, TX</p>
            <span class="ev-tag">Security &amp; Access Control</span>
          </div>
        </div>
        <?php endif; endif; ?>
      </div><!-- .events-track -->
      <div class="carousel-nav">
        <button class="carousel-btn" id="evPrev" aria-label="Previous">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <button class="carousel-btn" id="evNext" aria-label="Next">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ══ ABOUT SNAPSHOT ══ -->
<section class="section dark" id="about">
  <div class="section-inner">
    <div class="about-grid">
      <div class="about-copy">
        <span class="section-eyebrow reveal" style="--d:0s"><?php echo esc_html( _ef('about_eyebrow','About Excigent') ); ?></span>
        <h2 class="section-title reveal" style="--d:0.05s"><?php echo wp_kses_post( _ef('about_heading','Built on <strong>decades</strong> of industry leadership across broadband, ICT &amp; security.') ); ?></h2>
        <p class="reveal" style="--d:0.1s"><?php echo esc_html( _ef('about_para1','Excigent Tech Partners is a commercial agency and market development partner helping innovative companies expand across North America, Latin America, and the Caribbean.') ); ?></p>
        <p class="reveal" style="--d:0.18s"><?php echo esc_html( _ef('about_para2','We turn strong potential into market traction and revenue growth — through strategy, channel development, market positioning, and disciplined commercial execution.') ); ?></p>
        <div class="reveal" style="--d:0.24s;margin-top:1.8rem;">
          <?php excigent_link('about_cta', home_url('/about/'), 'Learn More About Us', 'btn-fill'); ?>
        </div>
      </div>
      <div class="about-stats">
        <?php
        $stats = function_exists('get_field') ? get_field('home_stats') : null;
        $default_stats = [
          ['num'=>'80','suffix'=>'+','label'=>'Years Combined Experience'],
          ['num'=>'3', 'suffix'=>'', 'label'=>'Core Technology Markets'],
          ['num'=>'3', 'suffix'=>'', 'label'=>'Geographic Regions'],
          ['num'=>'100','suffix'=>'+','label'=>'Partner Relationships'],
        ];
        $stats_data = $stats ?: $default_stats;
        foreach ($stats_data as $i => $s) :
          $num    = esc_html($s['num'] ?? $s['stat_number'] ?? '0');
          $suffix = esc_html($s['suffix'] ?? $s['stat_suffix'] ?? '');
          $label  = esc_html($s['label'] ?? $s['stat_label'] ?? '');
          $delay  = round($i * 0.10, 2);
        ?>
        <div class="stat reveal" style="--d:<?php echo $delay; ?>s">
          <div class="stat-num"><span class="count" data-target="<?php echo $num; ?>">0</span><?php if($suffix): ?><span class="suffix"><?php echo $suffix; ?></span><?php endif; ?></div>
          <div class="stat-label"><?php echo $label; ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══ CONVERGENCE ══ -->
<section class="section light" id="convergence">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s">What We Do</span>
    <h2 class="section-title reveal" style="--d:0.06s">The <strong>convergence</strong> of broadband, ICT, and security<br>defines the future of infrastructure.</h2>
    <p class="section-lead reveal" style="--d:0.12s">Each plays a distinct role — but their greatest value is realized when they come together to create connected, intelligent, and secure environments.</p>
    <div class="pillars">
      <div class="pillar reveal" style="--d:0.05s">
        <div class="pillar-num">01 / Connect</div>
        <div class="pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1.5 8.5s5-4 10.5-4 10.5 4 10.5 4"/><path d="M5 12s3.5-2.5 7-2.5 7 2.5 7 2.5"/><path d="M8.5 15.5s1.75-1.5 3.5-1.5 3.5 1.5 3.5 1.5"/><circle cx="12" cy="19" r="1" fill="currentColor" stroke="none"/></svg></div>
        <h3>Broadband</h3>
        <p>The connected foundation — providing access, speed, and reach across fixed and wireless networks.</p>
      </div>
      <div class="pillar reveal" style="--d:0.15s">
        <div class="pillar-num">02 / Enable</div>
        <div class="pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="7" height="7" rx="1"/><rect x="15" y="3" width="7" height="7" rx="1"/><rect x="2" y="14" width="7" height="7" rx="1"/><rect x="15" y="14" width="7" height="7" rx="1"/><line x1="9" y1="6.5" x2="15" y2="6.5"/><line x1="9" y1="17.5" x2="15" y2="17.5"/><line x1="12" y1="10" x2="12" y2="14"/></svg></div>
        <h3>ICT</h3>
        <p>Systems and infrastructure that power communication, data flow, and operations across the enterprise.</p>
      </div>
      <div class="pillar reveal" style="--d:0.25s">
        <div class="pillar-num">03 / Protect</div>
        <div class="pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L3 6.5V12c0 5 4 9 9 10 5-1 9-5 9-10V6.5L12 2z"/><polyline points="9 12 11 14 15 10"/></svg></div>
        <h3>Security</h3>
        <p>Technologies that safeguard people, assets, networks, and the physical environments where work happens.</p>
      </div>
    </div>
    <div style="text-align:center;margin-top:3rem;">
      <?php excigent_link('convergence_cta', home_url('/expertise/'), 'View Our Expertise', 'btn-fill dark'); ?>
    </div>
  </div>
</section>

<!-- ══ PROCESS PREVIEW ══ -->
<section class="section deep" id="process">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s">Our Approach</span>
    <h2 class="section-title reveal" style="--d:0.06s">A <strong>disciplined six-step</strong> path from market fit to revenue growth.</h2>
    <p class="section-lead reveal" style="--d:0.12s">Not introductions — execution. Each engagement moves principals through six stages designed to convert potential into sustainable commercial outcomes.</p>
    <div class="process-track reveal" style="--d:0.2s">
      <div class="process-line-bg"></div>
      <div class="process-line-fill"></div>
      <div class="steps">
        <div class="step"><div class="step-node">01</div><h4>Assess</h4><p>Market fit &amp; opportunity sizing.</p></div>
        <div class="step"><div class="step-node">02</div><h4>Align</h4><p>Right partners &amp; channels identified.</p></div>
        <div class="step"><div class="step-node">03</div><h4>Build</h4><p>Strategic relationships developed.</p></div>
        <div class="step"><div class="step-node">04</div><h4>Position</h4><p>Solutions positioned effectively.</p></div>
        <div class="step"><div class="step-node">05</div><h4>Activate</h4><p>Visibility opportunities executed.</p></div>
        <div class="step"><div class="step-node">06</div><h4>Grow</h4><p>Pipeline, traction &amp; revenue.</p></div>
      </div>
    </div>
    <div style="text-align:center;margin-top:3rem;">
      <?php excigent_link('process_cta', home_url('/services/'), 'See Our Services', 'btn-fill'); ?>
    </div>
  </div>
</section>

<!-- ══ AFFILIATIONS ══ -->
<?php get_template_part( 'template-parts/affiliations' ); ?>

<!-- ══ SUBSCRIBE ══ -->
<?php get_template_part( 'template-parts/subscribe', null, [ 'show_name' => true ] ); ?>

<?php get_footer(); ?>
