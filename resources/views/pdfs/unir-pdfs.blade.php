<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unir PDFs</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --red: #E24B4A; --red-light: #FCEBEB; --red-mid: #F09595; --red-dark: #A32D2D;
    --green: #1D9E75; --green-light: #E1F5EE; --green-dark: #085041;
    --amber: #BA7517; --amber-light: #FAEEDA;
    --blue: #185FA5; --blue-light: #E6F1FB;
    --bg: #F7F5F0; --surface: #FFFFFF; --surface-2: #F0EDE8;
    --border: rgba(0,0,0,0.1); --border-strong: rgba(0,0,0,0.18);
    --text: #1A1917; --text-2: #6B6860; --text-3: #A09E9A;
    --radius: 12px; --radius-sm: 8px;
    --font-display: 'Syne', sans-serif;
    --font-body: 'DM Sans', sans-serif;
    --font-mono: 'DM Mono', monospace;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: var(--font-body); background: var(--bg); color: var(--text); min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; padding: 48px 24px 80px; }
  .container { width: 100%; max-width: 580px; }

  .header { margin-bottom: 36px; }
  .logo { display: inline-flex; align-items: center; gap: 10px; margin-bottom: 20px; }
  .logo-icon { width: 40px; height: 40px; background: var(--red); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
  .logo-icon svg { width: 20px; height: 20px; fill: none; stroke: #fff; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
  .logo-name { font-family: var(--font-display); font-size: 17px; font-weight: 600; color: var(--text); letter-spacing: -0.3px; }
  .header h1 { font-family: var(--font-display); font-size: 36px; font-weight: 600; line-height: 1.1; letter-spacing: -1px; color: var(--text); margin-bottom: 10px; }
  .header h1 span { color: var(--red); }
  .header p { font-size: 14px; color: var(--text-2); line-height: 1.6; max-width: 420px; }

  .drop-zone { border: 1.5px dashed var(--border-strong); border-radius: var(--radius); padding: 40px 24px; text-align: center; cursor: pointer; background: var(--surface); transition: all 0.2s ease; position: relative; overflow: hidden; }
  .drop-zone::before { content: ''; position: absolute; inset: 0; background: var(--red-light); opacity: 0; transition: opacity 0.2s; }
  .drop-zone:hover::before, .drop-zone.drag-over::before { opacity: 1; }
  .drop-zone:hover, .drop-zone.drag-over { border-color: var(--red); }
  .drop-zone input { display: none; }
  .drop-icon-ring { width: 64px; height: 64px; border-radius: 50%; border: 1.5px solid var(--border-strong); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; background: var(--bg); position: relative; z-index: 1; transition: border-color 0.2s, background 0.2s; }
  .drop-zone:hover .drop-icon-ring, .drop-zone.drag-over .drop-icon-ring { border-color: var(--red); background: var(--red-light); }
  .drop-icon-ring svg { width: 26px; height: 26px; fill: none; stroke: var(--text-2); stroke-width: 1.6; stroke-linecap: round; stroke-linejoin: round; transition: stroke 0.2s; }
  .drop-zone:hover .drop-icon-ring svg, .drop-zone.drag-over .drop-icon-ring svg { stroke: var(--red); }
  .drop-title { font-family: var(--font-display); font-size: 16px; font-weight: 600; color: var(--text); margin-bottom: 6px; position: relative; z-index: 1; }
  .drop-sub { font-size: 13px; color: var(--text-2); margin-bottom: 16px; position: relative; z-index: 1; }
  .drop-formats { display: flex; justify-content: center; gap: 8px; position: relative; z-index: 1; }
  .fmt-tag { font-family: var(--font-mono); font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 99px; background: var(--surface-2); color: var(--text-2); border: 1px solid var(--border); letter-spacing: 0.3px; }

  .list-header { display: flex; align-items: center; justify-content: space-between; margin: 28px 0 10px; }
  .list-title { font-family: var(--font-display); font-size: 13px; font-weight: 600; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center; gap: 8px; }
  .count-badge { font-family: var(--font-mono); font-size: 11px; font-weight: 500; padding: 2px 7px; border-radius: 99px; background: var(--red-light); color: var(--red-dark); border: 1px solid var(--red-mid); }
  .list-meta { display: flex; align-items: center; gap: 10px; }
  .pages-total { font-family: var(--font-mono); font-size: 12px; color: var(--text-3); }
  .btn-clear { font-family: var(--font-body); font-size: 12px; color: var(--text-3); cursor: pointer; background: none; border: 1px solid var(--border); padding: 4px 10px; border-radius: var(--radius-sm); transition: all 0.15s; display: flex; align-items: center; gap: 4px; }
  .btn-clear:hover { background: var(--red-light); color: var(--red-dark); border-color: var(--red-mid); }
  .drag-hint { font-size: 11px; color: var(--text-3); margin-bottom: 8px; display: flex; align-items: center; gap: 5px; }
  .drag-hint svg { width: 12px; height: 12px; fill: none; stroke: currentColor; stroke-width: 1.8; }
  .file-list { display: flex; flex-direction: column; gap: 6px; }
  .file-item { display: flex; align-items: center; gap: 10px; padding: 11px 14px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-sm); cursor: grab; user-select: none; transition: all 0.15s; }
  .file-item:hover { border-color: var(--border-strong); box-shadow: 0 1px 4px rgba(0,0,0,0.06); }
  .file-item:active { cursor: grabbing; }
  .file-item.dragging { opacity: 0.3; }
  .file-item.drag-target { border-color: var(--red); background: var(--red-light); }
  .drag-handle { flex-shrink: 0; color: var(--text-3); display: flex; align-items: center; }
  .drag-handle svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; }
  .file-num { font-family: var(--font-mono); font-size: 11px; font-weight: 500; width: 22px; height: 22px; border-radius: 6px; background: var(--surface-2); color: var(--text-3); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .pdf-dot { width: 28px; height: 28px; border-radius: 7px; background: var(--red-light); flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
  .pdf-dot svg { width: 15px; height: 15px; fill: none; stroke: var(--red); stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
  .file-info { flex: 1; min-width: 0; }
  .file-name { font-size: 13px; font-weight: 500; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  .file-size { font-family: var(--font-mono); font-size: 11px; color: var(--text-3); margin-top: 1px; }
  .pages-pill { font-family: var(--font-mono); font-size: 11px; font-weight: 500; padding: 3px 8px; border-radius: 99px; background: var(--surface-2); color: var(--text-2); border: 1px solid var(--border); flex-shrink: 0; }
  .btn-remove { width: 24px; height: 24px; border-radius: 6px; background: none; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--text-3); transition: all 0.15s; }
  .btn-remove:hover { background: var(--red-light); color: var(--red); }
  .btn-remove svg { width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; }

  /* Quality */
  .quality-section { margin-top: 28px; }
  .section-label { font-family: var(--font-display); font-size: 13px; font-weight: 600; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
  .section-label svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
  .quality-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; }
  .quality-card { border: 1.5px solid var(--border); border-radius: var(--radius-sm); padding: 12px 8px; cursor: pointer; background: var(--surface); transition: all 0.15s; text-align: center; user-select: none; }
  .quality-card:hover { border-color: var(--border-strong); }
  .quality-card.selected { border-color: var(--red); background: var(--red-light); }
  .quality-card input { display: none; }
  .q-icon { font-size: 20px; margin-bottom: 7px; line-height: 1; }
  .q-name { font-family: var(--font-display); font-size: 12px; font-weight: 600; color: var(--text); margin-bottom: 3px; }
  .quality-card.selected .q-name { color: var(--red-dark); }
  .q-desc { font-size: 10px; color: var(--text-3); line-height: 1.4; }
  .quality-card.selected .q-desc { color: var(--red); }
  .q-badge { font-family: var(--font-mono); font-size: 10px; font-weight: 500; margin-top: 7px; padding: 2px 6px; border-radius: 99px; background: var(--surface-2); color: var(--text-2); display: inline-block; border: 1px solid var(--border); }
  .quality-card.selected .q-badge { background: rgba(226,75,74,0.12); color: var(--red-dark); border-color: var(--red-mid); }

  .info-box { margin-top: 10px; padding: 11px 13px; border-radius: var(--radius-sm); font-size: 12px; line-height: 1.55; display: flex; align-items: flex-start; gap: 8px; }
  .info-box svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 1.8; flex-shrink: 0; margin-top: 1px; stroke-linecap: round; stroke-linejoin: round; }
  .info-box.amber { background: var(--amber-light); color: var(--amber); border: 1px solid rgba(186,117,23,0.2); }
  .info-box.blue { background: var(--blue-light); color: var(--blue); border: 1px solid rgba(24,95,165,0.2); }

  /* Progress */
  .progress-wrap { display: none; margin-bottom: 12px; }
  .progress-wrap.visible { display: block; }
  .progress-top { display: flex; justify-content: space-between; font-family: var(--font-mono); font-size: 11px; color: var(--text-2); margin-bottom: 7px; }
  .progress-bg { height: 3px; background: var(--border); border-radius: 99px; overflow: hidden; }
  .progress-fill { height: 3px; background: var(--red); border-radius: 99px; width: 0%; transition: width 0.25s ease; }

  .error-card { display: none; align-items: center; gap: 10px; padding: 11px 14px; margin-bottom: 12px; background: var(--red-light); border: 1px solid var(--red-mid); border-radius: var(--radius-sm); font-size: 13px; color: var(--red-dark); }
  .error-card.visible { display: flex; }
  .error-card svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 1.8; flex-shrink: 0; stroke-linecap: round; }

  .result-card { display: flex; align-items: center; gap: 14px; padding: 16px; background: var(--green-light); border: 1px solid rgba(29,158,117,0.3); border-radius: var(--radius); margin-bottom: 12px; }
  .result-icon { flex-shrink: 0; color: var(--green); }
  .result-icon svg { width: 28px; height: 28px; fill: none; stroke: currentColor; stroke-width: 1.6; stroke-linecap: round; stroke-linejoin: round; }
  .result-body { flex: 1; }
  .result-body strong { font-family: var(--font-display); font-size: 14px; font-weight: 600; color: var(--green-dark); display: block; margin-bottom: 3px; }
  .result-body span { font-family: var(--font-mono); font-size: 11px; color: var(--green); display: block; }
  .result-saving { font-family: var(--font-mono); font-size: 11px; font-weight: 500; color: var(--green-dark); margin-top: 2px; }
  .btn-download { display: flex; align-items: center; gap: 6px; padding: 9px 16px; background: var(--green); color: #fff; border: none; border-radius: var(--radius-sm); font-family: var(--font-display); font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; flex-shrink: 0; transition: opacity 0.15s; white-space: nowrap; }
  .btn-download:hover { opacity: 0.85; }
  .btn-download svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

  .merge-section { margin-top: 24px; }
  .btn-merge { width: 100%; padding: 15px; background: var(--red); color: #fff; border: none; border-radius: var(--radius); font-family: var(--font-display); font-size: 16px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: opacity 0.15s, transform 0.1s; letter-spacing: -0.2px; }
  .btn-merge:hover:not(:disabled) { opacity: 0.88; }
  .btn-merge:active:not(:disabled) { transform: scale(0.99); }
  .btn-merge:disabled { background: var(--surface-2); color: var(--text-3); cursor: not-allowed; }
  .btn-merge svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }

  .privacy { margin-top: 16px; display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 12px; color: var(--text-3); }
  .privacy svg { width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 1.8; }
</style>
</head>
<body>
<div class="container">
  <header class="header">
    <div class="logo">
      <div class="logo-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <span class="logo-name">PDFUnir</span>
    </div>
    <h1>Combina tus<br><span>PDFs al instante</span></h1>
    <p>Arrastra varios PDFs o un ZIP, ordénalos y elige el nivel de compresión del resultado final.</p>
  </header>

  <div class="drop-zone" id="dropZone">
    <input type="file" id="fileInput" multiple accept=".pdf,.zip">
    <div class="drop-icon-ring"><svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg></div>
    <div class="drop-title">Arrastra tus archivos aquí</div>
    <div class="drop-sub">o haz clic para seleccionarlos</div>
    <div class="drop-formats">
      <span class="fmt-tag">.pdf</span>
      <span class="fmt-tag">.zip</span>
      <span class="fmt-tag">múltiples</span>
    </div>
  </div>

  <div id="fileListSection" style="display:none">
    <div class="list-header">
      <div class="list-title">Archivos <span class="count-badge" id="countBadge">0</span></div>
      <div class="list-meta">
        <span class="pages-total" id="pagesTotal"></span>
        <button class="btn-clear" id="clearBtn">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
          Limpiar
        </button>
      </div>
    </div>
    <div class="drag-hint">
      <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
      Arrastra para cambiar el orden
    </div>
    <div class="file-list" id="fileList"></div>
  </div>

  <div class="quality-section" id="qualitySection" style="display:none">
    <div class="section-label">
      <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
      Calidad del PDF final
    </div>
    <div class="quality-grid">
      <label class="quality-card" id="qc-original">
        <input type="radio" name="quality" value="original" checked>
        <div class="q-icon">💎</div>
        <div class="q-name">Original</div>
        <div class="q-desc">Sin cambios</div>
        <div class="q-badge">100%</div>
      </label>
      <label class="quality-card" id="qc-high">
        <input type="radio" name="quality" value="high">
        <div class="q-icon">⚖️</div>
        <div class="q-name">Alta</div>
        <div class="q-desc">Muy buena calidad</div>
        <div class="q-badge">~150 dpi</div>
      </label>
      <label class="quality-card" id="qc-medium">
        <input type="radio" name="quality" value="medium">
        <div class="q-icon">📦</div>
        <div class="q-name">Media</div>
        <div class="q-desc">Buen equilibrio</div>
        <div class="q-badge">~96 dpi</div>
      </label>
      <label class="quality-card" id="qc-low">
        <input type="radio" name="quality" value="low">
        <div class="q-icon">🗜️</div>
        <div class="q-name">Mínima</div>
        <div class="q-desc">Máxima compresión</div>
        <div class="q-badge">~72 dpi</div>
      </label>
    </div>
    <div class="info-box amber" id="infoBox" style="display:none">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span>Los modos Alta, Media y Mínima renderizan cada página como imagen para comprimir de verdad. El texto dejará de ser seleccionable pero el tamaño se reduce significativamente.</span>
    </div>
    <div class="info-box blue" id="infoBoxOriginal">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span>Modo Original: combina los PDFs sin ninguna pérdida de calidad. El texto sigue siendo seleccionable y copiable.</span>
    </div>
  </div>

  <div class="merge-section">
    <div class="progress-wrap" id="progressWrap">
      <div class="progress-top"><span id="progLabel">Procesando...</span><span id="progPct">0%</span></div>
      <div class="progress-bg"><div class="progress-fill" id="progBar"></div></div>
    </div>
    <div class="error-card" id="errorCard">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span id="errorText"></span>
    </div>
    <div id="resultArea" style="display:none">
      <div class="result-card">
        <div class="result-icon"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
        <div class="result-body">
          <strong>PDF combinado con éxito</strong>
          <span id="resultMeta"></span>
          <div class="result-saving" id="resultSaving"></div>
        </div>
        <a id="dlLink" class="btn-download" download="combinado.pdf">
          <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Descargar
        </a>
      </div>
    </div>
    <button class="btn-merge" id="mergeBtn" disabled>
      <svg viewBox="0 0 24 24"><rect x="2" y="7" width="9" height="14" rx="2"/><rect x="13" y="3" width="9" height="14" rx="2"/></svg>
      Combinar PDFs
    </button>
    <div class="privacy">
      <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      100% privado — todo ocurre en tu navegador
    </div>
  </div>
</div>

<!-- pdf.js para renderizar páginas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

// Quality settings: dpi scale and jpeg quality
const QUALITY = {
  original: null, // no rasterize
  high:     { scale: 2.0,  jpegQ: 0.82 },  // ~150 dpi
  medium:   { scale: 1.3,  jpegQ: 0.70 },  // ~96 dpi
  low:      { scale: 1.0,  jpegQ: 0.55 },  // ~72 dpi
};

const $ = id => document.getElementById(id);
let pdfFiles = [], dragSrcIdx = null, originalTotalSize = 0;

// UI refs
const dropZone = $('dropZone'), fileInput = $('fileInput');
const fileListSection = $('fileListSection'), fileListEl = $('fileList');
const countBadge = $('countBadge'), pagesTotal = $('pagesTotal');
const mergeBtn = $('mergeBtn'), clearBtn = $('clearBtn');
const qualitySection = $('qualitySection');
const progressWrap = $('progressWrap'), progBar = $('progBar'), progLabel = $('progLabel'), progPct = $('progPct');
const resultArea = $('resultArea'), resultMeta = $('resultMeta'), resultSaving = $('resultSaving'), dlLink = $('dlLink');
const errorCard = $('errorCard'), errorText = $('errorText');
const infoBox = $('infoBox'), infoBoxOriginal = $('infoBoxOriginal');

// Quality card selection
document.querySelectorAll('.quality-card').forEach(card => {
  card.addEventListener('click', () => {
    document.querySelectorAll('.quality-card').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
    const val = card.querySelector('input').value;
    infoBox.style.display = val === 'original' ? 'none' : 'flex';
    infoBoxOriginal.style.display = val === 'original' ? 'flex' : 'none';
  });
});
$('qc-original').classList.add('selected');

function getQuality() { return document.querySelector('input[name="quality"]:checked').value; }

// Drop / file input
dropZone.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', e => handleFiles(Array.from(e.target.files)));
dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('drag-over'); });
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
dropZone.addEventListener('drop', e => { e.preventDefault(); dropZone.classList.remove('drag-over'); handleFiles(Array.from(e.dataTransfer.files)); });
clearBtn.addEventListener('click', () => { pdfFiles = []; originalTotalSize = 0; renderList(); hideResult(); });

async function handleFiles(files) {
  hideError(); hideResult();
  for (const f of files) {
    if (f.name.toLowerCase().endsWith('.zip')) await extractZip(f);
    else if (f.type === 'application/pdf' || f.name.toLowerCase().endsWith('.pdf')) await addPdf(f);
  }
  renderList();
}

async function extractZip(zipFile) {
  try {
    const zip = await JSZip.loadAsync(zipFile);
    const pdfs = Object.values(zip.files).filter(f => !f.dir && f.name.toLowerCase().endsWith('.pdf'));
    pdfs.sort((a, b) => a.name.localeCompare(b.name));
    for (const entry of pdfs) {
      const blob = await entry.async('blob');
      await addPdf(new File([blob], entry.name.split('/').pop(), { type: 'application/pdf' }));
    }
  } catch(e) { showError('Error al leer el ZIP: ' + e.message); }
}

async function addPdf(file) {
  try {
    const bytes = await file.arrayBuffer();
    const doc = await PDFLib.PDFDocument.load(bytes, { ignoreEncryption: true });
    pdfFiles.push({ file, bytes: new Uint8Array(bytes), pages: doc.getPageCount(), name: file.name });
  } catch(e) { showError(`No se pudo leer "${file.name}"`); }
}

function renderList() {
  fileListEl.innerHTML = '';
  const n = pdfFiles.length;
  fileListSection.style.display = n ? 'block' : 'none';
  qualitySection.style.display = n ? 'block' : 'none';
  mergeBtn.disabled = n < 2;
  if (!n) return;
  countBadge.textContent = n;
  originalTotalSize = pdfFiles.reduce((s, f) => s + f.file.size, 0);
  const totalPages = pdfFiles.reduce((s, f) => s + f.pages, 0);
  pagesTotal.textContent = totalPages + ' págs. en total';

  pdfFiles.forEach((f, i) => {
    const item = document.createElement('div');
    item.className = 'file-item';
    item.draggable = true;
    item.innerHTML = `
      <div class="drag-handle"><svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></div>
      <div class="file-num">${i+1}</div>
      <div class="pdf-dot"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <div class="file-info">
        <div class="file-name" title="${f.name}">${f.name}</div>
        <div class="file-size">${fmtSize(f.file.size)}</div>
      </div>
      <span class="pages-pill">${f.pages} pág.</span>
      <button class="btn-remove" data-idx="${i}" aria-label="Eliminar"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    `;
    item.addEventListener('dragstart', () => { dragSrcIdx = i; item.classList.add('dragging'); });
    item.addEventListener('dragend', () => { item.classList.remove('dragging'); document.querySelectorAll('.file-item').forEach(el => el.classList.remove('drag-target')); });
    item.addEventListener('dragover', e => { e.preventDefault(); item.classList.add('drag-target'); });
    item.addEventListener('dragleave', () => item.classList.remove('drag-target'));
    item.addEventListener('drop', e => {
      e.preventDefault();
      if (dragSrcIdx !== null && dragSrcIdx !== i) {
        pdfFiles.splice(i, 0, pdfFiles.splice(dragSrcIdx, 1)[0]);
        dragSrcIdx = null; renderList();
      }
    });
    item.querySelector('.btn-remove').addEventListener('click', ev => {
      pdfFiles.splice(+ev.currentTarget.dataset.idx, 1);
      renderList(); hideResult();
    });
    fileListEl.appendChild(item);
  });
}

// ── Merge ──────────────────────────────────────────────────────────────
mergeBtn.addEventListener('click', mergePdfs);

async function mergePdfs() {
  hideError(); hideResult();
  mergeBtn.disabled = true;
  progressWrap.classList.add('visible');
  const quality = getQuality();

  try {
    let pdfBytes;
    if (quality === 'original') {
      pdfBytes = await mergeOriginal();
    } else {
      pdfBytes = await mergeRasterized(QUALITY[quality]);
    }

    const url = URL.createObjectURL(new Blob([pdfBytes], { type: 'application/pdf' }));
    dlLink.href = url;

    const finalSize = pdfBytes.length;
    const saved = originalTotalSize - finalSize;
    const savedPct = Math.round((saved / originalTotalSize) * 100);
    const totalPages = pdfFiles.reduce((s, f) => s + f.pages, 0);

    resultMeta.textContent = `${pdfFiles.length} archivos · ${totalPages} páginas · ${fmtSize(finalSize)}`;
    resultSaving.textContent = saved > 1024
      ? `↓ ${savedPct}% menos que el original (ahorro: ${fmtSize(saved)})`
      : `Tamaño original: ${fmtSize(originalTotalSize)}`;

    setProgress(100, 'Completado');
    resultArea.style.display = 'block';
  } catch(e) {
    showError('Error: ' + e.message);
    console.error(e);
  } finally {
    setTimeout(() => progressWrap.classList.remove('visible'), 1400);
    mergeBtn.disabled = pdfFiles.length < 2;
  }
}

// Original: merge with pdf-lib, no rasterization
async function mergeOriginal() {
  const merged = await PDFLib.PDFDocument.create();
  for (let i = 0; i < pdfFiles.length; i++) {
    setProgress(Math.round((i / pdfFiles.length) * 90), `Combinando "${pdfFiles[i].name}"...`);
    const src = await PDFLib.PDFDocument.load(pdfFiles[i].bytes, { ignoreEncryption: true });
    const pages = await merged.copyPages(src, src.getPageIndices());
    pages.forEach(p => merged.addPage(p));
  }
  setProgress(95, 'Guardando...');
  return await merged.save();
}

// Rasterized: render each page with pdf.js → jpeg → embed in pdf-lib
async function mergeRasterized({ scale, jpegQ }) {
  const merged = await PDFLib.PDFDocument.create();
  let globalPage = 0;
  const totalPages = pdfFiles.reduce((s, f) => s + f.pages, 0);

  for (let fi = 0; fi < pdfFiles.length; fi++) {
    setProgress(Math.round((globalPage / totalPages) * 90), `Renderizando "${pdfFiles[fi].name}"...`);

    const pdfDoc = await pdfjsLib.getDocument({ data: pdfFiles[fi].bytes.slice() }).promise;

    for (let pi = 1; pi <= pdfDoc.numPages; pi++) {
      const page = await pdfDoc.getPage(pi);
      const viewport = page.getViewport({ scale });

      const canvas = document.createElement('canvas');
      canvas.width  = Math.floor(viewport.width);
      canvas.height = Math.floor(viewport.height);
      const ctx = canvas.getContext('2d');

      await page.render({ canvasContext: ctx, viewport }).promise;

      // Canvas → JPEG bytes
      const jpegBytes = await new Promise(resolve => {
        canvas.toBlob(async blob => {
          const ab = await blob.arrayBuffer();
          resolve(new Uint8Array(ab));
        }, 'image/jpeg', jpegQ);
      });

      // Embed JPEG in new PDF page with exact dimensions
      const jpegImage = await merged.embedJpg(jpegBytes);
      const pdfPage = merged.addPage([jpegImage.width, jpegImage.height]);
      pdfPage.drawImage(jpegImage, { x: 0, y: 0, width: jpegImage.width, height: jpegImage.height });

      globalPage++;
      const pct = Math.round((globalPage / totalPages) * 90);
      setProgress(pct, `Comprimiendo página ${globalPage} de ${totalPages}...`);
    }
  }

  setProgress(95, 'Guardando PDF comprimido...');
  return await merged.save({ useObjectStreams: true });
}

// ── Helpers ────────────────────────────────────────────────────────────
function fmtSize(b) { return b >= 1048576 ? (b/1048576).toFixed(1)+' MB' : Math.round(b/1024)+' KB'; }
function setProgress(pct, label) { progBar.style.width = pct+'%'; progLabel.textContent = label; progPct.textContent = pct+'%'; }
function hideResult() { resultArea.style.display = 'none'; }
function hideError() { errorCard.classList.remove('visible'); }
function showError(msg) { errorText.textContent = msg; errorCard.classList.add('visible'); }
</script>
</body>
</html>
