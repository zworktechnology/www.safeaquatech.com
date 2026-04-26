<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Safe Aqua Tech – Free Water Quality Test</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<!-- Cloudflare Turnstile — replace data-sitekey with your key from dash.cloudflare.com -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --navy:       #0D1B2A;
  --navy-mid:   #1A3A5C;
  --blue:       #1565C0;
  --blue-light: #1B7FC4;
  --cyan:       #00B4D8;
  --cyan-soft:  #7EC8E3;
  --green:      #25D366;
  --bg:         #FFFFFF;
  --surface:    #F4F8FC;
  --border:     #E0EBF5;
  --text:       #0D1B2A;
  --muted:      #5A6E82;
  --subtle:     #94A3B8;
}

html { scroll-behavior: smooth; }
body {
  font-family: 'Inter', 'Segoe UI', sans-serif;
  color: var(--text);
  background: var(--bg);
  -webkit-font-smoothing: antialiased;
}

/* ═══════════════════════════════════════════════════════
   NAV
═══════════════════════════════════════════════════════ */
.nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  background: rgba(13,27,42,0.96);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid rgba(255,255,255,0.07);
  height: 64px; padding: 0 32px;
  display: flex; align-items: center; justify-content: space-between;
}
.nav-brand {
  font-size: 17px; font-weight: 800; color: #fff;
  letter-spacing: -0.3px;
  display: flex; align-items: center; gap: 8px;
}
.nav-brand-icon {
  width: 30px; height: 30px;
  background: linear-gradient(135deg, var(--cyan), var(--blue-light));
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px;
}
.nav-brand span { color: var(--cyan-soft); }
.nav-right { display: flex; align-items: center; gap: 14px; }
.nav-phone {
  color: rgba(255,255,255,0.55); font-size: 13px; font-weight: 500;
  text-decoration: none; display: none;
  transition: color 0.2s;
}
.nav-phone:hover { color: rgba(255,255,255,0.9); }
@media (min-width: 640px) { .nav-phone { display: block; } }
.nav-cta {
  display: flex; align-items: center; gap: 7px;
  background: var(--green); color: #fff;
  font-size: 13px; font-weight: 700;
  padding: 9px 18px; border-radius: 8px;
  text-decoration: none; letter-spacing: 0.1px;
  transition: filter 0.2s, transform 0.2s;
}
.nav-cta:hover { filter: brightness(1.08); transform: translateY(-1px); }

/* ═══════════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════════ */
.hero {
  position: relative;
  min-height: 100vh;
  background: linear-gradient(155deg, #061320 0%, #0C2540 45%, #0D3361 100%);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 100px 0 80px;
}

/* Background dot-grid overlay */
.hero::before {
  content: '';
  position: absolute; inset: 0;
  background-image: radial-gradient(rgba(0,180,216,0.07) 1px, transparent 1px);
  background-size: 38px 38px;
  pointer-events: none;
}

#bubble-canvas {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  pointer-events: none; z-index: 0;
}

/* Ambient glows */
.hero-glow {
  position: absolute; pointer-events: none; z-index: 0;
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(0,180,216,0.1) 0%, transparent 65%);
  top: -150px; right: -100px;
}
.hero-glow-2 {
  position: absolute; pointer-events: none; z-index: 0;
  width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(21,101,192,0.12) 0%, transparent 65%);
  bottom: -120px; left: -80px;
}

/* Two-column inner layout */
.hero-inner {
  position: relative; z-index: 2;
  width: 100%; max-width: 1160px;
  padding: 0 40px;
  display: grid;
  grid-template-columns: 1fr 480px;
  gap: 60px;
  align-items: center;
}
@media (max-width: 960px) {
  .hero-inner { grid-template-columns: 1fr; gap: 48px; padding: 0 24px; }
}

/* ── LEFT: content ── */
.hero-content { display: flex; flex-direction: column; }
@media (max-width: 960px) { .hero-content { align-items: center; text-align: center; } }

.hero-badge {
  display: inline-flex; align-items: center; gap: 8px; align-self: flex-start;
  background: rgba(0,180,216,0.1);
  border: 1px solid rgba(0,180,216,0.22);
  color: var(--cyan-soft);
  font-size: 11px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase;
  padding: 8px 16px; border-radius: 100px;
  margin-bottom: 28px;
  animation: fadeUp 0.6s cubic-bezier(.22,.68,0,1.2) both;
}
@media (max-width: 960px) { .hero-badge { align-self: center; } }

.badge-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--cyan);
  animation: blink 1.8s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.25} }

.hero h1 {
  font-size: clamp(32px, 4.8vw, 58px);
  font-weight: 900; color: #fff;
  line-height: 1.13; letter-spacing: -1.5px;
  margin-bottom: 22px;
  animation: fadeUp 0.7s cubic-bezier(.22,.68,0,1.2) both;
}
.hero h1 em {
  font-style: normal;
  background: linear-gradient(90deg, var(--cyan-soft) 0%, var(--cyan) 100%);
  -webkit-background-clip: text; background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-sub {
  font-size: clamp(14px, 1.8vw, 17px);
  color: rgba(255,255,255,0.6);
  line-height: 1.8; max-width: 500px;
  margin-bottom: 36px;
  animation: fadeUp 0.8s cubic-bezier(.22,.68,0,1.2) both;
}
.hero-sub strong { color: rgba(255,255,255,0.9); font-weight: 600; }

.hero-cta {
  display: flex; gap: 12px; flex-wrap: wrap;
  margin-bottom: 36px;
  animation: fadeUp 0.9s cubic-bezier(.22,.68,0,1.2) both;
}
@media (max-width: 960px) { .hero-cta { justify-content: center; } }

.btn-wa {
  display: inline-flex; align-items: center; gap: 9px;
  background: var(--green); color: #fff;
  font-size: 14.5px; font-weight: 700;
  padding: 14px 26px; border-radius: 10px;
  text-decoration: none;
  box-shadow: 0 4px 20px rgba(37,211,102,0.35);
  transition: transform 0.2s, box-shadow 0.2s;
}
.btn-wa:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(37,211,102,0.45); }

.btn-outline {
  display: inline-flex; align-items: center; gap: 9px;
  background: transparent; color: rgba(255,255,255,0.8);
  font-size: 14.5px; font-weight: 600;
  padding: 14px 26px; border-radius: 10px;
  text-decoration: none;
  border: 1.5px solid rgba(255,255,255,0.18);
  transition: background 0.2s, border-color 0.2s;
}
.btn-outline:hover { background: rgba(255,255,255,0.07); border-color: rgba(255,255,255,0.32); }

/* Mini trust badges */
.hero-trust {
  display: flex; flex-wrap: wrap; gap: 10px;
  animation: fadeUp 1s cubic-bezier(.22,.68,0,1.2) both;
}
@media (max-width: 960px) { .hero-trust { justify-content: center; } }
.trust-chip {
  display: flex; align-items: center; gap: 6px;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 100px;
  padding: 6px 13px;
  font-size: 12px; font-weight: 500;
  color: rgba(255,255,255,0.65);
}
.trust-chip-icon { font-size: 11px; }

/* ── RIGHT: interactive scanner ── */
.hero-visual {
  position: relative;
  width: 480px; height: 480px;
  flex-shrink: 0;
  animation: fadeUp 0.8s cubic-bezier(.22,.68,0,1.2) 0.2s both;
}
@media (max-width: 960px) {
  .hero-visual { width: 320px; height: 320px; margin: 0 auto; }
}

/* Parallax layer that moves on mousemove */
.scanner-parallax { width: 100%; height: 100%; position: relative; transition: transform 0.12s ease-out; }

/* Rotating rings */
.scanner-ring {
  position: absolute; top: 50%; left: 50%;
  border-radius: 50%; border-style: solid;
  transform: translate(-50%, -50%);
}
.ring-1 {
  width: 200px; height: 200px;
  border-width: 1.5px;
  border-color: rgba(0,180,216,0.35);
  animation: spinCW 16s linear infinite;
  /* small dashes via SVG-like trick */
  border-style: dashed;
}
.ring-2 {
  width: 290px; height: 290px;
  border-width: 1px;
  border-color: rgba(0,180,216,0.18);
  border-style: dashed;
  animation: spinCCW 22s linear infinite;
}
.ring-3 {
  width: 390px; height: 390px;
  border-width: 1px;
  border-color: rgba(0,180,216,0.09);
  border-style: dashed;
  animation: spinCW 30s linear infinite;
}
@media (max-width: 960px) {
  .ring-1 { width: 135px; height: 135px; }
  .ring-2 { width: 194px; height: 194px; }
  .ring-3 { width: 260px; height: 260px; }
}

/* Pulse rings (static, growing opacity wave) */
.pulse-ring {
  position: absolute; top: 50%; left: 50%;
  border-radius: 50%;
  border: 1.5px solid rgba(0,180,216,0.3);
  transform: translate(-50%, -50%) scale(0.6);
  opacity: 0;
  animation: pulseRing 3s ease-out infinite;
}
.pulse-ring:nth-child(2) { animation-delay: 1s; }
.pulse-ring:nth-child(3) { animation-delay: 2s; }
@keyframes pulseRing {
  0%   { transform: translate(-50%,-50%) scale(0.55); opacity: 0.7; }
  100% { transform: translate(-50%,-50%) scale(1.35); opacity: 0; }
}

/* Central orb */
.scanner-core {
  position: absolute; top: 50%; left: 50%;
  width: 160px; height: 160px;
  transform: translate(-50%, -50%);
  border-radius: 50%;
  background: linear-gradient(145deg, rgba(0,44,80,0.9), rgba(10,65,120,0.85));
  border: 1.5px solid rgba(0,180,216,0.4);
  box-shadow:
    0 0 0 6px rgba(0,180,216,0.06),
    0 0 40px rgba(0,180,216,0.15),
    inset 0 0 30px rgba(0,100,180,0.2);
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: 4px;
  overflow: hidden;
  z-index: 5;
  cursor: default;
}
@media (max-width: 960px) {
  .scanner-core { width: 108px; height: 108px; }
}

/* Scanning line inside the orb */
.scan-line {
  position: absolute; left: 12%; right: 12%; height: 1.5px;
  background: linear-gradient(90deg, transparent 0%, rgba(0,180,216,0.8) 50%, transparent 100%);
  filter: blur(0.5px);
  animation: scanDown 2.8s ease-in-out infinite;
}
@keyframes scanDown {
  0%   { top: 15%; opacity: 0; }
  8%   { opacity: 1; }
  92%  { opacity: 1; }
  100% { top: 85%; opacity: 0; }
}

.scanner-icon { font-size: 24px; position: relative; z-index: 1; }
.scanner-number {
  font-size: 36px; font-weight: 900; color: #fff;
  letter-spacing: -2px; line-height: 1;
  position: relative; z-index: 1;
}
.scanner-label {
  font-size: 10px; font-weight: 600; color: var(--cyan-soft);
  letter-spacing: 1.5px; text-transform: uppercase;
  position: relative; z-index: 1;
}
@media (max-width: 960px) {
  .scanner-icon { font-size: 16px; }
  .scanner-number { font-size: 26px; }
  .scanner-label { font-size: 8px; }
}

/* Metric cards */
.metric-card {
  position: absolute;
  background: rgba(10,30,55,0.85);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(0,180,216,0.2);
  border-radius: 14px;
  padding: 12px 15px;
  display: flex; align-items: center; gap: 10px;
  min-width: 140px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.35);
  transition: border-color 0.3s, box-shadow 0.3s;
  cursor: default;
  z-index: 6;
}
.metric-card:hover {
  border-color: rgba(0,180,216,0.5);
  box-shadow: 0 8px 40px rgba(0,180,216,0.15);
}
.mc-icon-wrap {
  width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 17px;
}
.mc-text { display: flex; flex-direction: column; gap: 3px; }
.mc-name { font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.55); letter-spacing: 0.3px; }
.mc-val { font-size: 12.5px; font-weight: 700; color: rgba(255,255,255,0.85); }
.mc-dot {
  width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0;
  margin-left: auto;
}
.dot-warn { background: #F59E0B; box-shadow: 0 0 6px rgba(245,158,11,0.6); animation: blink 2s ease-in-out infinite; }

/* Card positions */
.mc-tds    { top: 14px;  left: 10px;  animation: floatA 5s ease-in-out infinite; }
.mc-ph     { top: 14px;  right: 10px; animation: floatB 5.5s ease-in-out 0.4s infinite; }
.mc-bact   { bottom: 14px; right: 10px; animation: floatA 6s ease-in-out 0.8s infinite; }
.mc-hard   { bottom: 14px; left: 10px;  animation: floatB 5.2s ease-in-out 1.2s infinite; }

@media (max-width: 960px) {
  .metric-card { min-width: 110px; padding: 9px 11px; gap: 7px; border-radius: 11px; }
  .mc-icon-wrap { width: 28px; height: 28px; font-size: 13px; border-radius: 8px; }
  .mc-name { font-size: 9.5px; }
  .mc-val  { font-size: 10.5px; }
  .mc-tds  { top: 0;   left: -5px; }
  .mc-ph   { top: 0;   right: -5px; }
  .mc-bact { bottom: 0; right: -5px; }
  .mc-hard { bottom: 0; left: -5px; }
}

@keyframes floatA {
  0%,100% { transform: translateY(0px); }
  50%      { transform: translateY(-9px); }
}
@keyframes floatB {
  0%,100% { transform: translateY(-5px); }
  50%      { transform: translateY(4px); }
}

/* Scroll indicator */
.scroll-down {
  position: absolute; bottom: 28px; left: 50%; transform: translateX(-50%);
  z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 7px;
}
.scroll-down span {
  font-size: 10px; font-weight: 600; letter-spacing: 2px;
  text-transform: uppercase; color: rgba(255,255,255,0.3);
}
.scroll-arrow {
  width: 20px; height: 20px;
  border-right: 2px solid rgba(0,180,216,0.4);
  border-bottom: 2px solid rgba(0,180,216,0.4);
  transform: rotate(45deg);
  animation: bounceDown 1.6s ease-in-out infinite;
}
@keyframes bounceDown {
  0%,100% { transform: rotate(45deg) translateY(0); opacity: 0.6; }
  50%      { transform: rotate(45deg) translateY(6px); opacity: 1; }
}

/* Water waves */
.water-waves {
  position: absolute; bottom: 0; left: 0; right: 0;
  height: 60px; overflow: hidden; z-index: 1; pointer-events: none;
}
.wave {
  position: absolute; bottom: 0; width: 200%; height: 60px;
  background: rgba(255,255,255,0.035);
  border-radius: 40% 60% 60% 40% / 40% 40% 60% 60%;
  animation: waveMove 10s linear infinite;
}
.wave2 {
  animation: waveMove 15s linear infinite reverse;
  background: rgba(255,255,255,0.02);
}
@keyframes waveMove { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }

/* ═══════════════════════════════════════════════════════
   TRUST BAR
═══════════════════════════════════════════════════════ */
.trust-bar {
  background: #fff; border-bottom: 1px solid var(--border);
  padding: 28px 24px;
  display: flex; justify-content: center; align-items: center;
  flex-wrap: wrap;
}
.trust-item {
  text-align: center; padding: 8px 40px; position: relative;
}
.trust-item:not(:last-child)::after {
  content: ''; position: absolute; right: 0; top: 50%;
  transform: translateY(-50%); width: 1px; height: 30px;
  background: var(--border);
}
@media (max-width: 600px) {
  .trust-item { padding: 8px 18px; }
  .trust-item:not(:last-child)::after { display: none; }
}
.trust-num {
  font-size: 28px; font-weight: 900; color: var(--navy);
  letter-spacing: -1px; line-height: 1;
}
.trust-label {
  font-size: 10.5px; font-weight: 600; color: var(--subtle);
  text-transform: uppercase; letter-spacing: 1.2px; margin-top: 5px;
}

/* ═══════════════════════════════════════════════════════
   SHARED SECTION STYLES
═══════════════════════════════════════════════════════ */
.section-eyebrow {
  text-align: center; font-size: 10.5px; font-weight: 700;
  letter-spacing: 2.5px; text-transform: uppercase;
  color: var(--blue-light); margin-bottom: 12px;
}
.section-title {
  text-align: center;
  font-size: clamp(23px, 3.5vw, 36px);
  font-weight: 800; color: var(--navy);
  margin-bottom: 14px; line-height: 1.2; letter-spacing: -0.7px;
}
.section-body {
  text-align: center; font-size: 15.5px; color: var(--muted);
  max-width: 510px; margin: 0 auto 52px; line-height: 1.75;
}

/* ═══════════════════════════════════════════════════════
   HOW IT WORKS
═══════════════════════════════════════════════════════ */
.steps { background: var(--surface); padding: 88px 24px; }
.steps-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 20px; max-width: 1020px; margin: 0 auto;
}
.step-card {
  background: #fff; border-radius: 16px; padding: 36px 24px 28px;
  text-align: center; border: 1px solid var(--border); position: relative;
  transition: transform 0.22s, box-shadow 0.22s;
}
.step-card:hover { transform: translateY(-5px); box-shadow: 0 20px 48px rgba(13,27,42,0.09); }
.step-num {
  position: absolute; top: -13px; left: 50%; transform: translateX(-50%);
  background: var(--navy); color: #fff; font-size: 10px; font-weight: 800;
  letter-spacing: 1.5px; text-transform: uppercase;
  padding: 5px 14px; border-radius: 100px; white-space: nowrap;
}
.step-icon {
  width: 64px; height: 64px; border-radius: 16px;
  display: flex; align-items: center; justify-content: center;
  font-size: 26px; margin: 0 auto 20px;
}
.step-card h3 { font-size: 16px; font-weight: 700; color: var(--navy); margin-bottom: 10px; letter-spacing: -0.2px; }
.step-card p  { font-size: 13.5px; color: var(--muted); line-height: 1.7; }

/* ═══════════════════════════════════════════════════════
   PROBLEM
═══════════════════════════════════════════════════════ */
.problem { background: var(--navy); padding: 88px 24px; }
.problem .section-eyebrow { color: var(--cyan-soft); }
.problem .section-title   { color: #fff; }
.problem .section-body    { color: rgba(255,255,255,0.48); }
.problem-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px; max-width: 900px; margin: 0 auto;
}
.problem-card {
  background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.09);
  border-radius: 14px; padding: 28px 20px; text-align: center;
  transition: background 0.2s, border-color 0.2s;
}
.problem-card:hover { background: rgba(0,180,216,0.07); border-color: rgba(0,180,216,0.2); }
.problem-card .p-icon { font-size: 34px; margin-bottom: 14px; }
.problem-card h4 { font-size: 14px; font-weight: 700; color: #fff; margin-bottom: 8px; }
.problem-card p  { font-size: 13px; color: rgba(255,255,255,0.45); line-height: 1.65; }

/* ═══════════════════════════════════════════════════════
   OFFER + FORM COMBINED (6/12 + 6/12)
═══════════════════════════════════════════════════════ */
.offer-form-section { background: var(--surface); padding: 88px 24px; }
.offer-form-grid {
  max-width: 1160px; margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: start;
}
@media (max-width: 900px) {
  .offer-form-grid { grid-template-columns: 1fr; }
}
.offer-section { background: transparent; padding: 0; }
.offer-card {
  background: linear-gradient(145deg, #0F2D4E 0%, #1565C0 100%);
  border-radius: 24px; padding: 56px 48px; text-align: center; color: #fff;
  position: relative; overflow: hidden;
  box-shadow: 0 24px 64px rgba(21,101,192,0.28);
  height: 100%;
}
@media (max-width: 600px) { .offer-card { padding: 40px 22px; } }
.offer-card::before {
  content: '';
  position: absolute; width: 380px; height: 380px;
  background: radial-gradient(circle, rgba(0,180,216,0.14) 0%, transparent 70%);
  top: -100px; right: -80px; pointer-events: none;
}
.offer-pill {
  display: inline-flex; align-items: center; gap: 6px;
  background: rgba(37,211,102,0.15); border: 1px solid rgba(37,211,102,0.3);
  color: #5EF0A0; font-size: 10.5px; font-weight: 700;
  letter-spacing: 1.8px; text-transform: uppercase;
  padding: 7px 16px; border-radius: 100px; margin-bottom: 22px; position: relative;
}
.offer-card h2 {
  font-size: clamp(21px, 4vw, 34px); font-weight: 900;
  letter-spacing: -0.8px; line-height: 1.2; margin-bottom: 14px; position: relative;
}
.offer-card > p {
  font-size: 15px; color: rgba(255,255,255,0.68); line-height: 1.78;
  max-width: 450px; margin: 0 auto 32px; position: relative;
}
.offer-perks {
  display: flex; justify-content: center; gap: 24px; flex-wrap: wrap;
  margin-bottom: 36px; position: relative;
}
.perk { display: flex; align-items: center; gap: 7px; font-size: 13px; color: rgba(255,255,255,0.83); font-weight: 500; }
.perk svg { width: 14px; height: 14px; flex-shrink: 0; color: var(--cyan-soft); }
.offer-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; position: relative; }
.offer-btn-wa {
  display: inline-flex; align-items: center; gap: 9px;
  background: var(--green); color: #fff; font-size: 14.5px; font-weight: 700;
  padding: 14px 26px; border-radius: 10px; text-decoration: none;
  box-shadow: 0 4px 20px rgba(37,211,102,0.4); transition: transform 0.2s;
}
.offer-btn-wa:hover { transform: translateY(-2px); }
.offer-btn-call {
  display: inline-flex; align-items: center; gap: 9px;
  background: rgba(255,255,255,0.1); color: #fff; font-size: 14.5px; font-weight: 600;
  padding: 14px 26px; border-radius: 10px; text-decoration: none;
  border: 1.5px solid rgba(255,255,255,0.18); transition: background 0.2s;
}
.offer-btn-call:hover { background: rgba(255,255,255,0.18); }

/* ═══════════════════════════════════════════════════════
   FORM
═══════════════════════════════════════════════════════ */
.form-section { background: transparent; padding: 0; }
.form-wrap {
  background: #fff;
  border-radius: 20px; padding: 44px 40px;
  border: 1px solid var(--border);
  box-shadow: 0 16px 56px rgba(13,27,42,0.07);
}
@media (max-width: 600px) { .form-wrap { padding: 30px 20px; } }
.form-header { margin-bottom: 28px; }
.form-header h2 { font-size: 21px; font-weight: 800; color: var(--navy); letter-spacing: -0.4px; margin-bottom: 6px; }
.form-header p { font-size: 13px; color: var(--muted); line-height: 1.65; }
.field { margin-bottom: 14px; }
.field label {
  display: block; font-size: 11px; font-weight: 700; color: var(--muted);
  letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 7px;
}
.field input, .field select, .field textarea {
  width: 100%; padding: 12px 15px;
  border: 1.5px solid var(--border); border-radius: 10px;
  font-size: 14px; color: var(--text); background: var(--surface);
  outline: none; transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
  font-family: inherit; appearance: none;
}
.field input:focus, .field select:focus, .field textarea:focus {
  border-color: var(--blue-light); background: #fff;
  box-shadow: 0 0 0 3px rgba(27,127,196,0.1);
}
.field textarea { resize: none; height: 88px; }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
.field-row .field { margin-bottom: 0; }
@media (max-width: 480px) { .field-row { grid-template-columns: 1fr; } }
.submit-btn {
  width: 100%; background: linear-gradient(135deg, var(--navy-mid), var(--blue-light));
  color: #fff; font-size: 15px; font-weight: 700; padding: 15px;
  border: none; border-radius: 10px; cursor: pointer; margin-top: 6px;
  letter-spacing: 0.1px; transition: opacity 0.2s, transform 0.2s;
}
.submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }
.turnstile-wrap {
  display: flex; justify-content: center;
  margin: 14px 0 6px;
  min-height: 65px;
}
/* submit button loading spinner */
.btn-spinner {
  display: inline-block;
  width: 14px; height: 14px;
  border: 2px solid rgba(255,255,255,0.35);
  border-top-color: #fff;
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
  vertical-align: middle;
  margin-right: 4px;
}
@keyframes spin { to { transform: rotate(360deg); } }
/* form shake on validation error */
@keyframes shake {
  0%,100% { transform: translateX(0); }
  20%      { transform: translateX(-7px); }
  40%      { transform: translateX(7px); }
  60%      { transform: translateX(-5px); }
  80%      { transform: translateX(5px); }
}
.privacy-note {
  text-align: center; font-size: 12px; color: var(--subtle); margin-top: 13px;
  display: flex; align-items: center; justify-content: center; gap: 5px;
}
.success-msg { display: none; text-align: center; padding: 24px 0; }
.success-tick {
  width: 68px; height: 68px; background: #F0FFF6; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 32px; margin: 0 auto 18px; border: 1.5px solid #C3F0D5;
}
.success-msg h3 { font-size: 20px; font-weight: 800; color: var(--navy); margin-bottom: 8px; }
.success-msg p  { font-size: 14px; color: var(--muted); line-height: 1.65; }

/* ═══════════════════════════════════════════════════════
   TESTIMONIALS
═══════════════════════════════════════════════════════ */
.testimonials { background: var(--bg); padding: 88px 24px; }
.testi-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px; max-width: 980px; margin: 0 auto;
}
.testi-card {
  background: var(--surface); border-radius: 16px; padding: 30px 26px;
  border: 1px solid var(--border);
  transition: transform 0.2s, box-shadow 0.2s;
}
.testi-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(13,27,42,0.08); }
.quote-mark { font-size: 46px; line-height: 1; color: var(--border); font-family: Georgia, serif; font-weight: 900; margin-bottom: -6px; }
.stars { color: #F5A623; font-size: 13px; letter-spacing: 1px; margin-bottom: 14px; }
.testi-card p { font-size: 14px; color: #4A5568; line-height: 1.75; margin-bottom: 22px; }
.testi-author { display: flex; align-items: center; gap: 11px; }
.avatar {
  width: 40px; height: 40px; border-radius: 50%;
  background: linear-gradient(135deg, var(--navy-mid), var(--blue-light));
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
}
.author-name { font-size: 13px; font-weight: 700; color: var(--navy); }
.author-loc  { font-size: 11.5px; color: var(--subtle); margin-top: 2px; }

/* ═══════════════════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════════════════ */
.footer { background: var(--navy); padding: 52px 24px 28px; text-align: center; }
.footer-brand { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.footer-brand-icon {
  width: 30px; height: 30px;
  background: linear-gradient(135deg, var(--cyan), var(--blue-light));
  border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 14px;
}
.footer-logo { font-size: 19px; font-weight: 800; color: #fff; letter-spacing: -0.3px; }
.footer-logo span { color: var(--cyan-soft); }
.footer-tagline { font-size: 12.5px; color: rgba(255,255,255,0.38); margin-bottom: 28px; margin-top: 6px; }
.footer-links { display: flex; justify-content: center; gap: 6px; flex-wrap: wrap; margin-bottom: 24px; }
.footer-links a {
  color: rgba(255,255,255,0.52); text-decoration: none; font-size: 12px; font-weight: 500;
  padding: 6px 13px; border-radius: 7px; border: 1px solid rgba(255,255,255,0.09);
  transition: background 0.2s, color 0.2s;
}
.footer-links a:hover { background: rgba(255,255,255,0.08); color: #fff; }
.footer-contact { display: flex; justify-content: center; gap: 24px; flex-wrap: wrap; margin-bottom: 28px; }
.footer-contact a { color: var(--cyan-soft); text-decoration: none; font-size: 13px; font-weight: 600; transition: color 0.2s; }
.footer-contact a:hover { color: #fff; }
.footer-divider { height: 1px; background: rgba(255,255,255,0.07); max-width: 600px; margin: 0 auto 20px; }
.footer-address { font-size: 11.5px; color: rgba(255,255,255,0.28); margin-bottom: 5px; }
.footer-copy { font-size: 11px; color: rgba(255,255,255,0.18); }

/* ═══════════════════════════════════════════════════════
   STICKY WA
═══════════════════════════════════════════════════════ */
.sticky-wa {
  position: fixed; bottom: 24px; right: 24px; z-index: 999;
  width: 56px; height: 56px; background: var(--green); border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 6px 24px rgba(37,211,102,0.45); text-decoration: none;
  transition: transform 0.2s; animation: waPulse 2.8s infinite;
}
.sticky-wa:hover { transform: scale(1.1); }
.sticky-wa svg { width: 28px; height: 28px; fill: #fff; }

/* ═══════════════════════════════════════════════════════
   KEYFRAMES
═══════════════════════════════════════════════════════ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes spinCW  { to { transform: translate(-50%,-50%) rotate(360deg);  } }
@keyframes spinCCW { to { transform: translate(-50%,-50%) rotate(-360deg); } }
@keyframes waPulse {
  0%,100% { box-shadow: 0 6px 24px rgba(37,211,102,0.45); }
  50%      { box-shadow: 0 6px 42px rgba(37,211,102,0.75); }
}
</style>
</head>
<body>

<!-- ══════════ NAV ══════════ -->
<nav class="nav">
  <div class="nav-brand">
    <a href="{{ route('index') }}"><img src="{{ asset('assets/frontend/images/logo-white.webp') }}"
                            alt="logo" style="width: 150px;" /></a>
  </div>
  <div class="nav-right">
    <a href="tel:+919344330043" class="nav-phone" style="color: white">+91 93443 30043</a>
    <a href="https://api.whatsapp.com/send/?phone=919344330043&text=Hi!+I+saw+your+ad+and+want+a+free+water+quality+test." class="nav-cta" target="_blank">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.852L0 24l6.335-1.61A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.778 9.778 0 01-5.002-1.373l-.358-.213-3.756.985.998-3.66-.232-.375A9.778 9.778 0 012.182 12C2.182 6.57 6.569 2.182 12 2.182S21.818 6.569 21.818 12c0 5.43-4.388 9.818-9.818 9.818z"/></svg>
      Book Free Test on WhatsApp
    </a>
  </div>
</nav>

<!-- ══════════ HERO ══════════ -->
<section class="hero" id="hero-section">
  <canvas id="bubble-canvas"></canvas>
  <div class="hero-glow"></div>
  <div class="hero-glow-2"></div>

  <div class="hero-inner">

    <!-- LEFT: text content -->
    <div class="hero-content">
      <div class="hero-badge">
        <div class="badge-dot"></div>
        Limited Time — 100% Free
      </div>

      <h1>Is Your Water<br><em>Safe Enough</em><br>for Your Family?</h1>

      <p class="hero-sub">
        Most tap water in Trichy contains hidden impurities you can't see or taste.
        Book your <strong>free 22-point water quality test</strong> —
        no obligation, doorstep service.
      </p>

      <div class="hero-cta">
        <a href="https://api.whatsapp.com/send/?phone=919344330043&text=Hi!+I+saw+your+YouTube+ad+and+want+a+free+water+quality+test." class="btn-wa" target="_blank">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.852L0 24l6.335-1.61A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.778 9.778 0 01-5.002-1.373l-.358-.213-3.756.985.998-3.66-.232-.375A9.778 9.778 0 012.182 12C2.182 6.57 6.569 2.182 12 2.182S21.818 6.569 21.818 12c0 5.43-4.388 9.818-9.818 9.818z"/></svg>
          Book Free Test on WhatsApp
        </a>
        <a href="tel:+919344330043" class="btn-outline">
          📞 Call Us Now
        </a>
      </div>

      <div class="hero-trust">
        <div class="trust-chip"><span class="trust-chip-icon">✓</span> 19+ Years Experience</div>
        <div class="trust-chip"><span class="trust-chip-icon">✓</span> Free Doorstep Service</div>
        <div class="trust-chip"><span class="trust-chip-icon">✓</span> Same-Day Results</div>
      </div>
    </div>

    <!-- RIGHT: interactive water quality scanner -->
    <div class="hero-visual" id="hero-visual">
      <div class="scanner-parallax" id="scanner-parallax">

        <!-- Pulse rings -->
        <div class="pulse-ring" style="width:160px;height:160px;"></div>
        <div class="pulse-ring" style="width:160px;height:160px;"></div>
        <div class="pulse-ring" style="width:160px;height:160px;"></div>

        <!-- Rotating rings -->
        <div class="scanner-ring ring-1"></div>
        <div class="scanner-ring ring-2"></div>
        <div class="scanner-ring ring-3"></div>

        <!-- Central orb -->
        <div class="scanner-core" id="scanner-core">
          <div class="scan-line"></div>
          <div class="scanner-icon">💧</div>
          <div class="scanner-number">22</div>
          <div class="scanner-label">Points Tested</div>
        </div>

        <!-- Floating metric cards -->
        <div class="metric-card mc-tds">
          <div class="mc-icon-wrap" style="background:rgba(0,180,216,0.12);">⚗️</div>
          <div class="mc-text">
            <div class="mc-name">TDS Level</div>
            <div class="mc-val">Unchecked</div>
          </div>
          <div class="mc-dot dot-warn"></div>
        </div>

        <div class="metric-card mc-ph">
          <div class="mc-icon-wrap" style="background:rgba(245,158,11,0.12);">🧪</div>
          <div class="mc-text">
            <div class="mc-name">pH Balance</div>
            <div class="mc-val">Unknown</div>
          </div>
          <div class="mc-dot dot-warn"></div>
        </div>

        <div class="metric-card mc-bact">
          <div class="mc-icon-wrap" style="background:rgba(239,68,68,0.12);">🦠</div>
          <div class="mc-text">
            <div class="mc-name">Bacteria</div>
            <div class="mc-val">Not Tested</div>
          </div>
          <div class="mc-dot dot-warn"></div>
        </div>

        <div class="metric-card mc-hard">
          <div class="mc-icon-wrap" style="background:rgba(139,92,246,0.12);">🪨</div>
          <div class="mc-text">
            <div class="mc-name">Hardness</div>
            <div class="mc-val">Uncertain</div>
          </div>
          <div class="mc-dot dot-warn"></div>
        </div>

      </div><!-- /.scanner-parallax -->
    </div><!-- /.hero-visual -->

  </div><!-- /.hero-inner -->

  <!-- Scroll indicator -->
  <div class="scroll-down">
    <span>Scroll</span>
    <div class="scroll-arrow"></div>
  </div>

  <div class="water-waves">
    <div class="wave"></div>
    <div class="wave wave2"></div>
  </div>
</section>

<!-- ══════════ TRUST BAR ══════════ -->
<div class="trust-bar">
  <div class="trust-item"><div class="trust-num">19+</div><div class="trust-label">Years of Trust</div></div>
  <div class="trust-item"><div class="trust-num">150+</div><div class="trust-label">Happy Clients</div></div>
  <div class="trust-item"><div class="trust-num">22</div><div class="trust-label">Point Water Test</div></div>
  <div class="trust-item"><div class="trust-num">100%</div><div class="trust-label">Free, No Strings</div></div>
</div>

<!-- ══════════ HOW IT WORKS ══════════ -->
<section class="steps">
  <p class="section-eyebrow">How it works</p>
  <h2 class="section-title">Clean Water in 4 Simple Steps</h2>
  <p class="section-body">We make getting pure water at home completely effortless — from test to installation.</p>
  <div class="steps-grid">
    <div class="step-card">
      <div class="step-num">Step 01</div>
      <div class="step-icon" style="background:#EDFAF3;">💬</div>
      <h3>Book for Free</h3>
      <p>WhatsApp or call us. We schedule a visit at your convenience — zero charges, no commitment.</p>
    </div>
    <div class="step-card">
      <div class="step-num">Step 02</div>
      <div class="step-icon" style="background:#EBF4FD;">🧪</div>
      <h3>22-Point Test</h3>
      <p>Our expert visits your home and runs a comprehensive test — TDS, pH, hardness, bacteria & more.</p>
    </div>
    <div class="step-card">
      <div class="step-num">Step 03</div>
      <div class="step-icon" style="background:#FDF6E9;">📊</div>
      <h3>Get Your Report</h3>
      <p>We explain exactly what's in your water and recommend the right purifier for your home.</p>
    </div>
    <div class="step-card">
      <div class="step-num">Step 04</div>
      <div class="step-icon" style="background:#FFF0ED;">✅</div>
      <h3>Enjoy Pure Water</h3>
      <p>We install your purifier the same day. Your family gets clean, safe water — right away.</p>
    </div>
  </div>
</section>

<!-- ══════════ PROBLEM ══════════ -->
<section class="problem">
  <p class="section-eyebrow">The problem</p>
  <h2 class="section-title">What Could Be Hiding in Your Water?</h2>
  <p class="section-body">Trichy's tap water often contains contaminants that regular boiling cannot remove.</p>
  <div class="problem-grid">
    <div class="problem-card">
      <div class="p-icon">🦠</div>
      <h4>Bacteria &amp; Viruses</h4>
      <p>Invisible microbes that cause illness, stomach infections &amp; more.</p>
    </div>
    <div class="problem-card">
      <div class="p-icon">⚗️</div>
      <h4>High TDS Levels</h4>
      <p>Dissolved salts that make water taste bitter and damage kidneys over time.</p>
    </div>
    <div class="problem-card">
      <div class="p-icon">🪨</div>
      <h4>Hard Water</h4>
      <p>Causes white deposits, hair fall, dry skin &amp; appliance damage.</p>
    </div>
    <div class="problem-card">
      <div class="p-icon">☠️</div>
      <h4>Heavy Metals</h4>
      <p>Lead, arsenic &amp; fluoride that accumulate in the body silently.</p>
    </div>
  </div>
</section>

<!-- ══════════ OFFER + FORM (6/12 + 6/12) ══════════ -->
<section class="offer-form-section">
  <div class="offer-form-grid">

  <!-- LEFT: Offer -->
  <section class="offer-section">
  <div class="offer-card">
    <div class="offer-pill">🎁 Exclusive YouTube Ad Offer</div>
    <h2>Get Your FREE 22-Point Water Quality Test Today</h2>
    <p>Valued at ₹999 — yours absolutely free, just for watching our ad. Our expert comes to your doorstep anywhere in Trichy.</p>
    <div class="offer-perks">
      <div class="perk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Doorstep service</div>
      <div class="perk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Same-day results</div>
      <div class="perk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> No purchase required</div>
      <div class="perk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> 100% free</div>
    </div>
    <div class="offer-actions">
      <a href="https://api.whatsapp.com/send/?phone=919344330043&text=Hi!+I+saw+your+YouTube+ad+and+I+want+to+book+my+free+22-point+water+quality+test." class="offer-btn-wa" target="_blank">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.852L0 24l6.335-1.61A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.778 9.778 0 01-5.002-1.373l-.358-.213-3.756.985.998-3.66-.232-.375A9.778 9.778 0 012.182 12C2.182 6.57 6.569 2.182 12 2.182S21.818 6.569 21.818 12c0 5.43-4.388 9.818-9.818 9.818z"/></svg>
        WhatsApp to Book Now
      </a>
      <a href="tel:+919344330043" class="offer-btn-call">Call +91 93443 30043</a>
    </div>
  </div>
  </section>

  <!-- RIGHT: Form -->
  <section class="form-section">
  <div class="form-wrap">
    <div class="form-header">
      <h2>Book Free Water Test</h2>
      <p>Our expert visits your home — zero cost, zero obligation.</p>
    </div>
    <div id="form-body">
      <div class="field-row">
        <div class="field">
          <label>Full Name</label>
          <input type="text" id="fname" placeholder="e.g. Ramesh Kumar" />
        </div>
        <div class="field">
          <label>Mobile Number</label>
          <input type="tel" id="fphone" placeholder="+91 XXXXX XXXXX" />
        </div>
      </div>
      <div class="field-row">
      <div class="field">
        <label>Water Source</label>
        <select id="fsource">
          <option value="">Select your water source</option>
          <option>Corporation / Municipal Water</option>
          <option>Borewell Water</option>
          <option>Well Water</option>
          <option>Tanker Water</option>
        </select>
      </div>
      <div class="field">
        <label>Best Time to Visit (optional)</label>
        <select id="ftime">
          <option value="">Any time works</option>
          <option>Morning (9am – 12pm)</option>
          <option>Afternoon (12pm – 3pm)</option>
          <option>Evening (3pm – 7pm)</option>
        </select>
      </div>
      </div>
      <div class="field">
        <label>Your Area in Trichy</label>
        <input type="text" id="farea" placeholder="e.g. Mannarpuram, Ariyamangalam..." />
      </div>
      <!-- Invisible Turnstile — executed fresh on every submit -->
      <div id="turnstile-container"></div>
      <button class="submit-btn" onclick="submitForm()">Book My Free Water Test →</button>
      <p class="privacy-note">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Your details are safe. We never spam.
      </p>
    </div>
    <div class="success-msg" id="success">
      <div class="success-tick">✅</div>
      <h3>Booking Confirmed!</h3>
      <p>We'll call you within 2 hours to confirm your slot.<br>Meanwhile, WhatsApp us for a faster response.</p>
      <br>
      <a href="https://api.whatsapp.com/send/?phone=919344330043&text=Hi!+I+just+submitted+my+details+for+the+free+water+test." class="offer-btn-wa" style="display:inline-flex;margin-top:8px;" target="_blank">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.852L0 24l6.335-1.61A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.778 9.778 0 01-5.002-1.373l-.358-.213-3.756.985.998-3.66-.232-.375A9.778 9.778 0 012.182 12C2.182 6.57 6.569 2.182 12 2.182S21.818 6.569 21.818 12c0 5.43-4.388 9.818-9.818 9.818z"/></svg>
        WhatsApp Us Now
      </a>
    </div>
  </div>
  </section>

  </div><!-- /.offer-form-grid -->
</section><!-- /.offer-form-section -->

<!-- ══════════ TESTIMONIALS ══════════ -->
<section class="testimonials">
  <p class="section-eyebrow">Real customers</p>
  <h2 class="section-title">Families in Trichy Trust Us</h2>
  <p class="section-body">Over 150 homes and businesses served with clean, pure water.</p>
  <div class="testi-grid">
    <div class="testi-card">
      <div class="quote-mark">"</div>
      <div class="stars">★★★★★</div>
      <p>Water taste has completely changed. No more strange smell. The team was professional and installed everything within an hour.</p>
      <div class="testi-author">
        <div class="avatar">RK</div>
        <div><div class="author-name">Ramesh K.</div><div class="author-loc">Ariyamangalam, Trichy</div></div>
      </div>
    </div>
    <div class="testi-card">
      <div class="quote-mark">"</div>
      <div class="stars">★★★★★</div>
      <p>I was skeptical about the free test but they came, tested and explained everything clearly. Installed a purifier the same day!</p>
      <div class="testi-author">
        <div class="avatar">SP</div>
        <div><div class="author-name">Sangeetha P.</div><div class="author-loc">Mannarpuram, Trichy</div></div>
      </div>
    </div>
    <div class="testi-card">
      <div class="quote-mark">"</div>
      <div class="stars">★★★★★</div>
      <p>My kids had frequent stomach issues. After Safe Aqua Tech's RO, health improved significantly. Highly recommend to every family.</p>
      <div class="testi-author">
        <div class="avatar">MV</div>
        <div><div class="author-name">Murugan V.</div><div class="author-loc">Srirangam, Trichy</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer class="footer">
  <div class="footer-brand">
     <a href="{{ route('index') }}"><img src="{{ asset('assets/frontend/images/logo-white.webp') }}"
                            alt="logo" style="width: 150px;" /></a>
  </div>
  <div class="footer-tagline">Trichy's Trusted Water Purification Experts — 19+ Years of Pure Service</div>
  <div class="footer-links">
    <a href="{{ route('index') }}">Home</a>
    <a href="{{ route('about') }}">About</a>
    <a href="{{ route('service') }}">Services</a>
    <a href="{{ route('product') }}">Products</a>
    <a href="{{ route('blog') }}">Blog</a>
    <a href="{{ route('contact') }}">Contact</a>
  </div>
  <div class="footer-contact">
    <a href="tel:+919344330043">📞 +91 93443 30043</a>
    <a href="mailto:info@safeaquatech.com">✉️ info@safeaquatech.com</a>
    <a href="https://api.whatsapp.com/send/?phone=919344330043" target="_blank">💬 WhatsApp Us</a>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-address">Mannarpuram, Tiruchirapalli, Tamil Nadu &nbsp;·&nbsp; Mon–Sat: 10am – 7pm</div>
  <div class="footer-copy">© 2024 Safe Aqua Tech. All Rights Reserved.</div>
</footer>

<!-- ══════════ STICKY WHATSAPP ══════════ -->
<a href="https://api.whatsapp.com/send/?phone=919344330043&text=Hi!+I+want+to+book+my+free+water+quality+test." class="sticky-wa" target="_blank">
  <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.852L0 24l6.335-1.61A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.778 9.778 0 01-5.002-1.373l-.358-.213-3.756.985.998-3.66-.232-.375A9.778 9.778 0 012.182 12C2.182 6.57 6.569 2.182 12 2.182S21.818 6.569 21.818 12c0 5.43-4.388 9.818-9.818 9.818z"/></svg>
</a>

<script>
/* ═══════════════════════════════════════════════════════
   BUBBLE ANIMATION
═══════════════════════════════════════════════════════ */
(function() {
  const canvas = document.getElementById('bubble-canvas');
  const hero   = document.getElementById('hero-section');
  const ctx    = canvas.getContext('2d');
  let bubbles  = [], animId;

  function resize() { canvas.width = hero.offsetWidth; canvas.height = hero.offsetHeight; }
  resize();
  window.addEventListener('resize', resize);

  function rand(a, b) { return a + Math.random() * (b - a); }

  function spawnBubble(x, y, fromClick) {
    const n = fromClick ? Math.floor(rand(6,14)) : 1;
    for (let i = 0; i < n; i++) {
      const r = fromClick ? rand(4,18) : rand(2,10);
      bubbles.push({
        x: x + (fromClick ? rand(-30,30) : 0),
        y: y || canvas.height + r,
        r, speedY: rand(0.5,1.6), speedX: rand(-0.3,0.3),
        wobble: rand(0, Math.PI*2), wobbleSpeed: rand(0.02,0.05),
        wobbleAmp: rand(0.3,1.0), alpha: rand(0.18,0.5),
        fadeSpeed: rand(0.003,0.007),
      });
    }
  }

  setInterval(() => spawnBubble(rand(0, canvas.width), null, false), 350);

  for (let i = 0; i < 18; i++) {
    bubbles.push({
      x: rand(0, window.innerWidth), y: rand(0, window.innerHeight),
      r: rand(2,10), speedY: rand(0.5,1.6), speedX: rand(-0.3,0.3),
      wobble: rand(0,Math.PI*2), wobbleSpeed: rand(0.02,0.05),
      wobbleAmp: rand(0.3,1.0), alpha: rand(0.1,0.4),
      fadeSpeed: rand(0.003,0.007),
    });
  }

  function onPointer(e) {
    const rect = canvas.getBoundingClientRect();
    const pts  = e.touches || [e];
    for (const t of pts) spawnBubble(t.clientX - rect.left, t.clientY - rect.top, true);
  }
  hero.addEventListener('mousedown', onPointer);
  hero.addEventListener('touchstart', onPointer, { passive: true });

  let lastMove = 0;
  hero.addEventListener('mousemove', e => {
    if (Date.now() - lastMove < 90) return;
    lastMove = Date.now();
    const rect = canvas.getBoundingClientRect();
    spawnBubble(e.clientX - rect.left, e.clientY - rect.top, false);
  });

  function drawBubble(b) {
    ctx.save();
    ctx.globalAlpha = b.alpha;
    ctx.beginPath();
    ctx.arc(b.x, b.y, b.r, 0, Math.PI*2);
    ctx.strokeStyle = 'rgba(180,230,255,0.75)';
    ctx.lineWidth = Math.max(0.8, b.r * 0.12);
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(b.x - b.r*0.3, b.y - b.r*0.3, b.r*0.26, 0, Math.PI*2);
    ctx.fillStyle = 'rgba(255,255,255,0.45)';
    ctx.fill();
    const g = ctx.createRadialGradient(b.x, b.y-b.r*0.3, b.r*0.1, b.x, b.y, b.r);
    g.addColorStop(0, 'rgba(160,220,255,0.14)');
    g.addColorStop(1, 'rgba(80,170,240,0.03)');
    ctx.beginPath();
    ctx.arc(b.x, b.y, b.r, 0, Math.PI*2);
    ctx.fillStyle = g; ctx.fill();
    ctx.restore();
  }

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    bubbles = bubbles.filter(b => {
      b.wobble += b.wobbleSpeed;
      b.x += b.speedX + Math.sin(b.wobble) * b.wobbleAmp;
      b.y -= b.speedY; b.alpha -= b.fadeSpeed;
      drawBubble(b);
      return b.alpha > 0 && b.y + b.r > -20;
    });
    animId = requestAnimationFrame(animate);
  }
  animate();

  new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) { if (!animId) animate(); }
    else { cancelAnimationFrame(animId); animId = null; }
  }).observe(hero);
})();

/* ═══════════════════════════════════════════════════════
   MOUSE PARALLAX — scanner visual
═══════════════════════════════════════════════════════ */
(function() {
  const hero     = document.getElementById('hero-section');
  const parallax = document.getElementById('scanner-parallax');
  const core     = document.getElementById('scanner-core');
  if (!parallax) return;

  let targetX = 0, targetY = 0, curX = 0, curY = 0;
  let raf;

  hero.addEventListener('mousemove', e => {
    const r = hero.getBoundingClientRect();
    targetX = ((e.clientX - r.left) / r.width  - 0.5) * 2; // -1 to 1
    targetY = ((e.clientY - r.top)  / r.height - 0.5) * 2;
  });

  hero.addEventListener('mouseleave', () => { targetX = 0; targetY = 0; });

  function tick() {
    curX += (targetX - curX) * 0.06;
    curY += (targetY - curY) * 0.06;
    // Gentle move of the whole scanner
    parallax.style.transform = `translate(${curX * 14}px, ${curY * 10}px)`;
    // Slightly different movement for the core (depth illusion)
    core.style.transform     = `translate(calc(-50% + ${curX * 6}px), calc(-50% + ${curY * 5}px))`;
    raf = requestAnimationFrame(tick);
  }
  tick();

  // Pause when out of view
  new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) { if (!raf) tick(); }
    else { cancelAnimationFrame(raf); raf = null; }
  }).observe(hero);
})();

/* ═══════════════════════════════════════════════════════
   FORM SUBMIT
═══════════════════════════════════════════════════════ */
/* ═══════════════════════════════════════════════════════
   FORM SUBMIT  — Cloudflare Turnstile server-side verify
   Worker URL:  replace WORKER_URL below after deploying
   worker.js from the same folder.
═══════════════════════════════════════════════════════ */
function getFreshTurnstileToken() {
  return new Promise((resolve, reject) => {
    const container = document.getElementById('turnstile-container');
    container.innerHTML = '';
    turnstile.render(container, {
      sitekey:          '{{ config("services.turnstile.site_key") }}',
      size:             'invisible',
      callback:         resolve,
      'error-callback': () => reject(new Error('Turnstile error')),
      'expired-callback': () => reject(new Error('Turnstile expired')),
    });
    turnstile.execute(container);
  });
}

async function submitForm() {
  const name   = document.getElementById('fname').value.trim();
  const phone  = document.getElementById('fphone').value.trim();
  const area   = document.getElementById('farea').value.trim();
  const source = document.getElementById('fsource').value;
  const time   = document.getElementById('ftime').value;

  if (!name || !phone) {
    shakeForm();
    showFormError('Please enter your name and mobile number.');
    return;
  }

  const btn = document.querySelector('.submit-btn');
  btn.disabled = true;
  btn.innerHTML = '<span class="btn-spinner"></span> Submitting…';

  let token;
  try {
    token = await getFreshTurnstileToken();
  } catch (e) {
    showFormError('Security check failed. Please try again.');
    resetBtn(btn);
    return;
  }

  try {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const res  = await fetch('{{ route("gads.store") }}', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
      body: JSON.stringify({
        'cf-turnstile-response': token,
        name, phone, area, source, time,
      }),
    });

    const data = await res.json();

    if (!res.ok || !data.success) {
      showFormError(data.error || 'Submission failed. Please try again.');
      resetBtn(btn);
      return;
    }

    document.getElementById('form-body').style.display = 'none';
    document.getElementById('success').style.display   = 'block';

  } catch (err) {
    showFormError('Network error. Please try WhatsApp or call us directly.');
    resetBtn(btn);
  }
}

function resetBtn(btn) {
  btn.disabled = false;
  btn.innerHTML = 'Book My Free Water Test →';
}

function showFormError(msg) {
  let el = document.getElementById('form-error');
  if (!el) {
    el = document.createElement('p');
    el.id = 'form-error';
    el.style.cssText = 'color:#E53E3E;font-size:13px;text-align:center;margin-top:10px;font-weight:600;';
    document.querySelector('.submit-btn').insertAdjacentElement('afterend', el);
  }
  el.textContent = msg;
  setTimeout(() => { if (el) el.textContent = ''; }, 5000);
}

function shakeForm() {
  const wrap = document.querySelector('.form-wrap');
  wrap.style.animation = 'shake 0.4s ease';
  wrap.addEventListener('animationend', () => wrap.style.animation = '', { once: true });
}
</script>
</body>
</html>
