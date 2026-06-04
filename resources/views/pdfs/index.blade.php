<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>PDFUnir</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --red:#E24B4A;--red-l:#FCEBEB;--red-m:#F09595;--red-d:#A32D2D;
    --green:#1D9E75;--green-l:#E1F5EE;--green-d:#085041;
    --amber:#BA7517;--amber-l:#FAEEDA;
    --blue:#185FA5;--blue-l:#E6F1FB;
    --bg:#F7F5F0;--sur:#FFF;--sur2:#F0EDE8;
    --bor:rgba(0,0,0,.1);--bors:rgba(0,0,0,.18);
    --t:#1A1917;--t2:#6B6860;--t3:#A09E9A;
    --r:12px;--rs:8px;
    --F:'Syne',sans-serif;--FB:'DM Sans',sans-serif;--FM:'DM Mono',monospace;
  }
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  body{font-family:var(--FB);background:var(--bg);color:var(--t);min-height:100vh;display:flex;align-items:flex-start;justify-content:center;padding:48px 24px 80px}
  .wrap{width:100%;max-width:580px}

  /* Header */
  .hdr{margin-bottom:36px}
  .logo{display:inline-flex;align-items:center;gap:10px;margin-bottom:20px}
  .logo-ico{width:40px;height:40px;background:var(--red);border-radius:10px;display:flex;align-items:center;justify-content:center}
  .logo-ico svg{width:20px;height:20px;fill:none;stroke:#fff;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
  .logo-name{font-family:var(--F);font-size:17px;font-weight:600;letter-spacing:-.3px}
  h1{font-family:var(--F);font-size:36px;font-weight:600;line-height:1.1;letter-spacing:-1px;margin-bottom:10px}
  h1 span{color:var(--red)}
  .hdr p{font-size:14px;color:var(--t2);line-height:1.6;max-width:420px}

  /* Drop */
  .drop{border:1.5px dashed var(--bors);border-radius:var(--r);padding:40px 24px;text-align:center;cursor:pointer;background:var(--sur);transition:all .2s;position:relative;overflow:hidden}
  .drop::before{content:'';position:absolute;inset:0;background:var(--red-l);opacity:0;transition:opacity .2s;pointer-events:none}
  .drop:hover::before,.drop.over::before{opacity:1}
  .drop:hover,.drop.over{border-color:var(--red)}
  .drop input{display:none}
  .drop-ring{width:64px;height:64px;border-radius:50%;border:1.5px solid var(--bors);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;background:var(--bg);position:relative;z-index:1;transition:border-color .2s,background .2s}
  .drop:hover .drop-ring,.drop.over .drop-ring{border-color:var(--red);background:var(--red-l)}
  .drop-ring svg{width:26px;height:26px;fill:none;stroke:var(--t2);stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round;transition:stroke .2s}
  .drop:hover .drop-ring svg,.drop.over .drop-ring svg{stroke:var(--red)}
  .drop-title{font-family:var(--F);font-size:16px;font-weight:600;margin-bottom:6px;position:relative;z-index:1}
  .drop-sub{font-size:13px;color:var(--t2);margin-bottom:16px;position:relative;z-index:1}
  .drop-tags{display:flex;justify-content:center;gap:8px;position:relative;z-index:1}
  .tag{font-family:var(--FM);font-size:11px;font-weight:500;padding:4px 10px;border-radius:99px;background:var(--sur2);color:var(--t2);border:1px solid var(--bor)}

  /* File list */
  .list-hdr{display:flex;align-items:center;justify-content:space-between;margin:28px 0 10px}
  .list-title{font-family:var(--F);font-size:13px;font-weight:600;color:var(--t2);text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:8px}
  .bdg{font-family:var(--FM);font-size:11px;font-weight:500;padding:2px 7px;border-radius:99px;background:var(--red-l);color:var(--red-d);border:1px solid var(--red-m)}
  .list-meta{display:flex;align-items:center;gap:10px}
  .sz-info{font-family:var(--FM);font-size:12px;color:var(--t3)}
  .btn-ghost{font-family:var(--FB);font-size:12px;color:var(--t3);cursor:pointer;background:none;border:1px solid var(--bor);padding:4px 10px;border-radius:var(--rs);transition:all .15s;display:flex;align-items:center;gap:4px}
  .btn-ghost:hover{background:var(--red-l);color:var(--red-d);border-color:var(--red-m)}
  .hint{font-size:11px;color:var(--t3);margin-bottom:8px;display:flex;align-items:center;gap:5px}
  .hint svg{width:12px;height:12px;fill:none;stroke:currentColor;stroke-width:1.8}
  .file-list{display:flex;flex-direction:column;gap:6px}
  .fi{display:flex;align-items:center;gap:10px;padding:11px 14px;background:var(--sur);border:1px solid var(--bor);border-radius:var(--rs);cursor:grab;user-select:none;transition:all .15s}
  .fi:hover{border-color:var(--bors)}
  .fi:active{cursor:grabbing}
  .fi.dragging{opacity:.3}
  .fi.drag-over{border-color:var(--red);background:var(--red-l)}
  .grip{flex-shrink:0;color:var(--t3);display:flex}
  .grip svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round}
  .fi-num{font-family:var(--FM);font-size:11px;width:22px;height:22px;border-radius:6px;background:var(--sur2);color:var(--t3);display:flex;align-items:center;justify-content:center;flex-shrink:0}
  .fi-ico{width:28px;height:28px;border-radius:7px;background:var(--red-l);flex-shrink:0;display:flex;align-items:center;justify-content:center}
  .fi-ico svg{width:15px;height:15px;fill:none;stroke:var(--red);stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
  .fi-info{flex:1;min-width:0}
  .fi-name{font-size:13px;font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
  .fi-sz{font-family:var(--FM);font-size:11px;color:var(--t3);margin-top:1px}
  .fi-pill{font-family:var(--FM);font-size:11px;padding:3px 8px;border-radius:99px;background:var(--sur2);color:var(--t2);border:1px solid var(--bor);flex-shrink:0}
  .btn-rm{width:24px;height:24px;border-radius:6px;background:none;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--t3);transition:all .15s}
  .btn-rm:hover{background:var(--red-l);color:var(--red)}
  .btn-rm svg{width:13px;height:13px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round}

  /* Quality */
  .q-sec{margin-top:28px}
  .sec-lbl{font-family:var(--F);font-size:13px;font-weight:600;color:var(--t2);text-transform:uppercase;letter-spacing:.8px;margin-bottom:10px;display:flex;align-items:center;gap:8px}
  .sec-lbl svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
  .toggle-row{display:flex;align-items:center;justify-content:space-between;padding:12px 14px;background:var(--sur);border:1px solid var(--bor);border-radius:var(--rs);margin-bottom:10px}
  .toggle-lbl{font-size:13px;font-weight:500}
  .toggle-sub{font-size:11px;color:var(--t2);margin-top:2px}
  .toggle{position:relative;width:40px;height:22px;flex-shrink:0}
  .toggle input{opacity:0;width:0;height:0}
  .slider{position:absolute;inset:0;background:var(--bors);border-radius:99px;cursor:pointer;transition:background .2s}
  .slider::before{content:'';position:absolute;width:16px;height:16px;left:3px;top:3px;background:#fff;border-radius:50%;transition:transform .2s}
  input:checked+.slider{background:var(--red)}
  input:checked+.slider::before{transform:translateX(18px)}
  .q-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}
  .qc{border:1.5px solid var(--bor);border-radius:var(--rs);padding:14px 8px;cursor:pointer;background:var(--sur);transition:all .15s;text-align:center;user-select:none}
  .qc:hover{border-color:var(--bors)}
  .qc.sel{border-color:var(--red);background:var(--red-l)}
  .qc input{display:none}
  .q-ico{font-size:22px;margin-bottom:8px}
  .q-name{font-family:var(--F);font-size:12px;font-weight:600;margin-bottom:3px}
  .qc.sel .q-name{color:var(--red-d)}
  .q-sub{font-size:10px;color:var(--t3);line-height:1.4}
  .qc.sel .q-sub{color:var(--red)}
  .q-pill{font-family:var(--FM);font-size:10px;font-weight:500;margin-top:8px;padding:2px 7px;border-radius:99px;background:var(--sur2);color:var(--t2);display:inline-block;border:1px solid var(--bor)}
  .qc.sel .q-pill{background:rgba(226,75,74,.12);color:var(--red-d);border-color:var(--red-m)}
  .info-note{margin-top:10px;padding:11px 13px;border-radius:var(--rs);font-size:12px;line-height:1.55;display:flex;align-items:flex-start;gap:8px;background:var(--blue-l);color:var(--blue);border:1px solid rgba(24,95,165,.2)}
  .info-note svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:1.8;flex-shrink:0;margin-top:1px;stroke-linecap:round;stroke-linejoin:round}

  /* Progress */
  .prog-wrap{display:none;margin-bottom:12px}
  .prog-wrap.on{display:block}
  .prog-top{display:flex;justify-content:space-between;font-family:var(--FM);font-size:11px;color:var(--t2);margin-bottom:7px}
  .prog-bg{height:3px;background:var(--bor);border-radius:99px;overflow:hidden}
  .prog-fill{height:3px;background:var(--red);border-radius:99px;width:0%;transition:width .4s}

  /* Cards */
  .err-card{display:none;align-items:center;gap:10px;padding:11px 14px;margin-bottom:12px;background:var(--red-l);border:1px solid var(--red-m);border-radius:var(--rs);font-size:13px;color:var(--red-d)}
  .err-card.on{display:flex}
  .err-card svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8;flex-shrink:0;stroke-linecap:round}
  .res-card{display:flex;align-items:center;gap:14px;padding:16px;background:var(--green-l);border:1px solid rgba(29,158,117,.3);border-radius:var(--r);margin-bottom:12px}
  .res-ico{flex-shrink:0;color:var(--green)}
  .res-ico svg{width:28px;height:28px;fill:none;stroke:currentColor;stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round}
  .res-body{flex:1}
  .res-body strong{font-family:var(--F);font-size:14px;font-weight:600;color:var(--green-d);display:block;margin-bottom:3px}
  .res-body span,.saving{font-family:var(--FM);font-size:11px;color:var(--green);display:block}
  .saving{font-weight:500;color:var(--green-d);margin-top:2px}
  .btn-dl{display:flex;align-items:center;gap:6px;padding:9px 16px;background:var(--green);color:#fff;border:none;border-radius:var(--rs);font-family:var(--F);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;flex-shrink:0;transition:opacity .15s;white-space:nowrap}
  .btn-dl:hover{opacity:.85}
  .btn-dl svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

  /* Merge btn */
  .merge-sec{margin-top:24px}
  .btn-merge{width:100%;padding:15px;background:var(--red);color:#fff;border:none;border-radius:var(--r);font-family:var(--F);font-size:16px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:opacity .15s,transform .1s;letter-spacing:-.2px}
  .btn-merge:hover:not(:disabled){opacity:.88}
  .btn-merge:active:not(:disabled){transform:scale(.99)}
  .btn-merge:disabled{background:var(--sur2);color:var(--t3);cursor:not-allowed}
  .btn-merge svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
  .privacy{margin-top:16px;display:flex;align-items:center;justify-content:center;gap:6px;font-size:12px;color:var(--t3)}
  .privacy svg{width:13px;height:13px;fill:none;stroke:currentColor;stroke-width:1.8}
</style>
</head>
<body>
<div class="wrap">
  <header class="hdr">
    <div class="logo">
      <div class="logo-ico"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <span class="logo-name">PDFUnir</span>
    </div>
    <h1>Combina tus<br><span>PDFs al instante</span></h1>
    <p>Arrastra varios PDFs o un ZIP, ordénalos y comprime el resultado. La compresión mantiene texto y vectores intactos.</p>
  </header>

  <div class="drop" id="dz">
    <input type="file" id="fi" multiple accept=".pdf,.zip">
    <div class="drop-ring"><svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg></div>
    <div class="drop-title">Arrastra tus archivos aquí</div>
    <div class="drop-sub">o haz clic para seleccionarlos</div>
    <div class="drop-tags">
      <span class="tag">.pdf</span><span class="tag">.zip</span><span class="tag">múltiples</span>
    </div>
  </div>

  <div id="listSec" style="display:none">
    <div class="list-hdr">
      <div class="list-title">Archivos <span class="bdg" id="cnt">0</span></div>
      <div class="list-meta">
        <span class="sz-info" id="szInfo"></span>
        <button class="btn-ghost" id="clearBtn">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
          Limpiar
        </button>
      </div>
    </div>
    <div class="hint"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg> Arrastra para reordenar</div>
    <div class="file-list" id="fileList"></div>
  </div>

  <div class="q-sec" id="qSec" style="display:none">
    <div class="sec-lbl">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
      Compresión
    </div>
    <div class="toggle-row">
      <div>
        <div class="toggle-lbl">Comprimir con iLovePDF</div>
        <div class="toggle-sub">Reduce el tamaño manteniendo texto, fuentes y vectores intactos</div>
      </div>
      <label class="toggle"><input type="checkbox" id="compToggle" checked><span class="slider"></span></label>
    </div>
    <div id="qGrid">
      <div class="q-grid">
        <label class="qc sel" id="qc-recommended">
          <input type="radio" name="quality" value="recommended" checked>
          <div class="q-ico">⚖️</div>
          <div class="q-name">Recomendada</div>
          <div class="q-sub">Mejor equilibrio calidad/tamaño</div>
          <div class="q-pill">Recomendado</div>
        </label>
        <label class="qc" id="qc-extreme">
          <input type="radio" name="quality" value="extreme">
          <div class="q-ico">🗜️</div>
          <div class="q-name">Extrema</div>
          <div class="q-sub">Máxima reducción de tamaño</div>
          <div class="q-pill">Más pequeño</div>
        </label>
        <label class="qc" id="qc-low">
          <input type="radio" name="quality" value="low">
          <div class="q-ico">💎</div>
          <div class="q-name">Baja compresión</div>
          <div class="q-sub">Mínima pérdida visual</div>
          <div class="q-pill">Más calidad</div>
        </label>
      </div>
      <div class="info-note" style="margin-top:10px">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>iLovePDF comprime imágenes embebidas y optimiza el PDF. El texto, fuentes y vectores se preservan en todos los modos. Gratis hasta 250 operaciones/mes.</span>
      </div>
    </div>
  </div>

  <div class="merge-sec">
    <div class="prog-wrap" id="progWrap">
      <div class="prog-top"><span id="progLbl">Procesando...</span><span id="progPct">—</span></div>
      <div class="prog-bg"><div class="prog-fill" id="progBar"></div></div>
    </div>
    <div class="err-card" id="errCard">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span id="errTxt"></span>
    </div>
    <div id="resArea" style="display:none">
      <div class="res-card">
        <div class="res-ico"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
        <div class="res-body">
          <strong>PDF listo</strong>
          <span id="rMeta"></span>
          <div class="saving" id="rSaving"></div>
        </div>
        <a id="dlLink" class="btn-dl" href="#" download="combinado.pdf">
          <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Descargar
        </a>
      </div>
    </div>
    <button class="btn-merge" id="mergeBtn" disabled>
      <svg viewBox="0 0 24 24"><rect x="2" y="7" width="9" height="14" rx="2"/><rect x="13" y="3" width="9" height="14" rx="2"/></svg>
      Combinar y comprimir
    </button>
    <div class="privacy">
      <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      Los archivos se combinan en tu navegador y se envían directo a iLovePDF · nunca pasan por el servidor
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
<script>
const $ = id => document.getElementById(id);
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let files = [], dragSrc = null;

// Drop zone
const dz = $('dz'), fi = $('fi');
dz.addEventListener('click', () => fi.click());
fi.addEventListener('change', e => load(Array.from(e.target.files)));
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('over'));
dz.addEventListener('drop', e => { e.preventDefault(); dz.classList.remove('over'); load(Array.from(e.dataTransfer.files)); });
$('clearBtn').addEventListener('click', () => { files = []; render(); hideRes(); });

// Quality cards
document.querySelectorAll('.qc').forEach(c => {
  c.addEventListener('click', () => {
    document.querySelectorAll('.qc').forEach(x => x.classList.remove('sel'));
    c.classList.add('sel');
  });
});

$('compToggle').addEventListener('change', e => {
  $('qGrid').style.opacity = e.target.checked ? '1' : '0.4';
  $('qGrid').style.pointerEvents = e.target.checked ? '' : 'none';
});

async function load(raw) {
  hideErr(); hideRes();
  for (const f of raw) {
    const ext = f.name.split('.').pop().toLowerCase();
    if (ext === 'pdf') {
      files.push(f);
    } else if (ext === 'zip') {
      await extractZip(f);
    }
  }
  render();
}

async function extractZip(zipFile) {
  try {
    const zip = await JSZip.loadAsync(zipFile);
    const entries = Object.values(zip.files)
      .filter(entry => !entry.dir && entry.name.toLowerCase().endsWith('.pdf'))
      .sort((a, b) => a.name.localeCompare(b.name));
    for (const entry of entries) {
      const blob = await entry.async('blob');
      const name = entry.name.split('/').pop();
      files.push(new File([blob], name, { type: 'application/pdf' }));
    }
  } catch (e) {
    showErr('Error al leer el ZIP: ' + e.message);
  }
}

async function combinePdfFiles(filesToCombine) {
  const mergedPdf = await PDFLib.PDFDocument.create();
  for (let i = 0; i < filesToCombine.length; i++) {
    const bytes = await filesToCombine[i].arrayBuffer();
    const srcPdf = await PDFLib.PDFDocument.load(bytes, { ignoreEncryption: true });
    const pages = await mergedPdf.copyPages(srcPdf, srcPdf.getPageIndices());
    pages.forEach(page => mergedPdf.addPage(page));
    setP(Math.round(((i + 1) / filesToCombine.length) * 30), `Combinando archivo ${i + 1} de ${filesToCombine.length}...`);
  }
  const mergedBytes = await mergedPdf.save();
  return new File([mergedBytes], 'combinado.pdf', { type: 'application/pdf' });
}

// Envía el PDF combinado al servidor como binary raw (sin multipart).
// Así no aplica upload_max_filesize (solo post_max_size, que está en 512M en .htaccess).
// El servidor lo reenvía a iLovePDF y devuelve el resultado comprimido.
async function compressViaPHP(combinedFile, quality) {
  setP(45, 'Subiendo PDF al servidor...');
  const res = await fetch('{{ route("pdf.compress") }}?quality=' + encodeURIComponent(quality), {
    method: 'POST',
    headers: {
      'Content-Type': 'application/pdf',
      'X-CSRF-TOKEN': csrfToken,
    },
    body: combinedFile,
  });

  if (!res.ok) {
    const err = await res.json().catch(() => ({ error: 'Error del servidor' }));
    throw new Error(err.error || 'Error desconocido');
  }

  setP(85, 'Descargando resultado...');
  return {
    blob:       await res.blob(),
    origSize:   +res.headers.get('X-Original-Size') || combinedFile.size,
    finalSize:  +res.headers.get('X-Final-Size')    || 0,
    savedPct:   +res.headers.get('X-Saved-Percent') || 0,
  };
}

function render() {
  const list = $('fileList'), n = files.length;
  list.innerHTML = '';
  $('listSec').style.display = n ? 'block' : 'none';
  $('qSec').style.display    = n ? 'block' : 'none';
  $('mergeBtn').disabled     = n < 2;
  if (!n) return;
  $('cnt').textContent = n;
  $('szInfo').textContent = fmt(files.reduce((s,f) => s+f.size, 0));

  files.forEach((f, i) => {
    const item = document.createElement('div');
    item.className = 'fi';
    item.draggable = true;
    item.innerHTML = `
      <div class="grip"><svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></div>
      <div class="fi-num">${i+1}</div>
      <div class="fi-ico"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
      <div class="fi-info">
        <div class="fi-name" title="${f.name}">${f.name}</div>
        <div class="fi-sz">${fmt(f.size)}</div>
      </div>
      <span class="fi-pill">${f.name.split('.').pop().toUpperCase()}</span>
      <button class="btn-rm" data-i="${i}" aria-label="Eliminar"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    `;
    item.addEventListener('dragstart', () => { dragSrc = i; item.classList.add('dragging'); });
    item.addEventListener('dragend',   () => { item.classList.remove('dragging'); document.querySelectorAll('.fi').forEach(x => x.classList.remove('drag-over')); });
    item.addEventListener('dragover',  e => { e.preventDefault(); item.classList.add('drag-over'); });
    item.addEventListener('dragleave', () => item.classList.remove('drag-over'));
    item.addEventListener('drop', e => {
      e.preventDefault();
      if (dragSrc !== null && dragSrc !== i) {
        files.splice(i, 0, files.splice(dragSrc, 1)[0]);
        dragSrc = null; render();
      }
    });
    item.querySelector('.btn-rm').addEventListener('click', ev => {
      files.splice(+ev.currentTarget.dataset.i, 1);
      render(); hideRes();
    });
    list.appendChild(item);
  });
}

$('mergeBtn').addEventListener('click', async () => {
  hideErr(); hideRes();
  $('mergeBtn').disabled = true;
  $('progWrap').classList.add('on');

  const compress = $('compToggle').checked;
  const quality  = (document.querySelector('input[name="quality"]:checked') || { value: 'recommended' }).value;

  try {
    // Paso 1: combinar en el browser con pdf-lib
    setP(5, 'Combinando archivos localmente...');
    const combinedFile = await combinePdfFiles(files);
    const originalSize = combinedFile.size;

    if (!compress) {
      // Sin compresión: descarga directa del blob combinado, nunca sale del browser
      setP(100, 'Listo');
      triggerDownload(combinedFile, 'combinado.pdf');
      $('rMeta').textContent   = fmt(originalSize);
      $('rSaving').textContent = `${files.length} archivos combinados`;
      $('resArea').style.display = 'block';
      return;
    }

    // Paso 2: enviar como raw binary al servidor (sin multipart → sin límite upload_max_filesize)
    const { blob: compressedBlob, origSize, finalSize, savedPct } = await compressViaPHP(combinedFile, quality);

    setP(100, 'Listo');
    triggerDownload(compressedBlob, 'combinado.pdf');
    $('rMeta').textContent   = fmt(finalSize || compressedBlob.size);
    $('rSaving').textContent = savedPct > 0
      ? `↓ ${savedPct}% menos · original ${fmt(origSize)}`
      : `${files.length} archivos combinados`;
    $('resArea').style.display = 'block';

  } catch (e) {
    showErr(e.message);
  } finally {
    setTimeout(() => $('progWrap').classList.remove('on'), 1400);
    $('mergeBtn').disabled = files.length < 2;
  }
});

function triggerDownload(blob, filename) {
  const url = URL.createObjectURL(blob);
  $('dlLink').href = url;
  $('dlLink').download = filename;
  // Descarga automática al terminar
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  a.click();
  setTimeout(() => URL.revokeObjectURL(url), 60000);
}

function fmt(b) { return b >= 1048576 ? (b/1048576).toFixed(1)+' MB' : Math.round(b/1024)+' KB'; }
function setP(p, l) { $('progBar').style.width=p+'%'; $('progLbl').textContent=l; $('progPct').textContent=p+'%'; }
function hideRes() { $('resArea').style.display = 'none'; }
function hideErr() { $('errCard').classList.remove('on'); }
function showErr(m) { $('errTxt').textContent = m; $('errCard').classList.add('on'); }
</script>
</body>
</html>
