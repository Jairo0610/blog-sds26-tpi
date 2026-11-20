<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .sds-admin-page {
        --g-50: #f4faea;
        --g-100: #e8f4d4;
        --g-300: #b5dc7a;
        --g-500: #8cc63f;
        --g-600: #6fa52b;
        --g-700: #4f7918;
        --ink: #111613;
        --ink-2: #4a544d;
        --ink-3: #78827b;
        --line: #e3e8e0;
        --line-2: #cfd7cb;
        --bg: #f4f7f1;
        --danger: #c92a2a;
        --amber: #e8a317;
        --radius: 16px;

        min-height: 100vh;
        background:
            radial-gradient(900px 380px at 100% -10%, rgba(140, 198, 63, .16), transparent 60%),
            radial-gradient(700px 320px at -10% 0%, rgba(140, 198, 63, .08), transparent 60%),
            var(--bg);
        color: var(--ink);
        font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, sans-serif;
        -webkit-font-smoothing: antialiased;
    }
    .sds-admin-page *, .sds-admin-page *::before, .sds-admin-page *::after { box-sizing: border-box; }

    .sds-topbar {
        background: #ffffff;
        border-bottom: 1px solid var(--line);
    }
    .sds-topbar-inner {
        max-width: 1200px; margin: 0 auto; padding: 12px 24px;
        display: flex; align-items: center; justify-content: space-between; gap: 16px;
    }
    .sds-brand-group { display: inline-flex; align-items: center; gap: 14px; text-decoration: none; }
    .sds-logo-aseis { height: 30px; width: auto; max-width: none; display: block; }
    .sds-logo-sds { height: 38px; width: auto; max-width: none; display: block; }
    .sds-divider-v { width: 1px; height: 28px; background: var(--line-2); }
    .sds-back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 14px; border-radius: 999px;
        border: 1px solid var(--line-2); background: #fff;
        color: var(--ink); font-size: 13px; font-weight: 600; text-decoration: none;
        transition: all .15s ease;
    }
    .sds-back-btn:hover { background: var(--g-50); border-color: var(--g-500); color: var(--g-700); }

    .sds-main-wrap { max-width: 1200px; margin: 0 auto; padding: 24px 24px 56px; }
    .sds-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 12.5px; color: var(--ink-3); margin-bottom: 14px; }
    .sds-breadcrumb a { color: var(--ink-2); text-decoration: none; font-weight: 500; }
    .sds-breadcrumb a:hover { color: var(--g-700); text-decoration: underline; }
    .sds-breadcrumb .is-current { color: var(--ink); font-weight: 600; }

    .sds-page-header {
        position: relative; overflow: hidden; margin-bottom: 24px; padding: 22px 26px;
        border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f3faea 100%);
        border: 1px solid var(--line); box-shadow: 0 4px 24px rgba(17, 22, 19, .04);
    }
    .sds-page-tag {
        display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px;
        background: var(--g-100); color: var(--g-700); font-size: 11px; font-weight: 700;
        letter-spacing: .06em; text-transform: uppercase; margin-bottom: 8px;
    }
    .sds-page-tag::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--g-500); }
    .sds-page-title { margin: 0; font-size: 26px; font-weight: 800; line-height: 1.15; letter-spacing: -.01em; }
    .sds-page-subtitle { margin: 6px 0 0; font-size: 13.5px; color: var(--ink-2); }

    .sds-form-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.55fr) minmax(320px, 1fr);
        gap: 22px;
        align-items: start;
    }
    @media (max-width: 960px) { .sds-form-layout { grid-template-columns: 1fr; } }
    .sds-stack { display: flex; flex-direction: column; gap: 20px; }

    .sds-card {
        background: #fff; border: 1px solid var(--line); border-radius: var(--radius);
        padding: 22px; box-shadow: 0 2px 12px rgba(17, 22, 19, .035);
    }
    .sds-card-head {
        display: flex; align-items: center; gap: 12px; padding-bottom: 14px; margin-bottom: 18px;
        border-bottom: 1px solid #eff2ec;
    }
    .sds-step-badge {
        width: 28px; height: 28px; border-radius: 9px;
        background: linear-gradient(135deg, var(--g-500), var(--g-600)); color: #fff;
        font-size: 12.5px; font-weight: 800; display: inline-flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sds-card-title { margin: 0; font-size: 15px; font-weight: 700; }
    .sds-card-hint { margin: 2px 0 0; font-size: 12px; color: var(--ink-3); font-weight: 400; }

    .sds-field { margin-bottom: 18px; }
    .sds-field:last-child { margin-bottom: 0; }
    .sds-label-row { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 7px; }
    .sds-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 7px; }
    .sds-label-row .sds-label { margin-bottom: 0; }
    .sds-req { color: var(--danger); font-weight: 700; }
    .sds-opt { font-size: 12px; font-weight: 400; color: var(--ink-3); }
    .sds-counter { font-size: 11px; font-weight: 600; color: var(--ink-3); font-variant-numeric: tabular-nums; }
    .sds-counter.is-near { color: var(--amber); }
    .sds-counter.is-full { color: var(--danger); }

    .sds-input, .sds-select, .sds-textarea {
        width: 100%; border: 1.5px solid var(--line-2); border-radius: 12px; background: #fff;
        color: var(--ink); font-family: inherit; font-size: 14px; line-height: 1.5; padding: 11px 14px;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .sds-input:focus, .sds-select:focus, .sds-textarea:focus {
        outline: none; border-color: var(--g-500); box-shadow: 0 0 0 4px rgba(140, 198, 63, .2);
    }
    .sds-input.is-title { font-size: 16px; font-weight: 600; padding: 12px 15px; }
    .sds-select {
        appearance: none; -webkit-appearance: none; padding-right: 38px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2378827b' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
    }
    .sds-textarea { min-height: 200px; resize: vertical; line-height: 1.6; }
    .sds-field-foot { display: flex; justify-content: space-between; gap: 8px; margin-top: 6px; font-size: 11.5px; color: var(--ink-3); }
    .sds-error-text { margin: 6px 0 0; font-size: 12px; font-weight: 500; color: var(--danger); }
    .sds-input.has-error, .sds-select.has-error, .sds-textarea.has-error { border-color: var(--danger); }

    .sds-alert-error {
        margin-bottom: 20px; padding: 15px 18px; border-radius: 14px;
        border: 1px solid #ffc9c9; border-left: 4px solid var(--danger);
        background: #fff5f5; color: #9b1c1c; font-size: 13px;
    }
    .sds-alert-error ul { margin: 8px 0 0; padding-left: 18px; }

    .sds-radio-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .sds-choice-card {
        position: relative; display: flex; align-items: center; gap: 9px; padding: 11px 13px;
        border: 1.5px solid var(--line-2); border-radius: 12px; background: #fafbf9;
        font-size: 13px; font-weight: 600; cursor: pointer; transition: all .15s ease;
    }
    .sds-choice-card input { position: absolute; opacity: 0; pointer-events: none; }
    .sds-choice-dot { width: 9px; height: 9px; border-radius: 50%; background: var(--amber); flex-shrink: 0; }
    .sds-choice-card.is-publicado .sds-choice-dot { background: var(--g-500); }
    .sds-choice-card:hover { border-color: var(--g-500); background: var(--g-50); }
    .sds-choice-card:has(input:checked) {
        border-color: var(--g-500); background: var(--g-50); box-shadow: 0 0 0 3px rgba(140, 198, 63, .2);
    }

    .sds-authors-tools { margin-bottom: 10px; }
    .sds-authors-tools .sds-input { padding: 8px 12px; font-size: 13px; }
    .sds-authors-count {
        white-space: nowrap; font-size: 11.5px; font-weight: 700; color: var(--g-700);
        background: var(--g-100); padding: 4px 10px; border-radius: 999px;
    }
    .sds-authors-list { display: flex; flex-direction: column; gap: 8px; max-height: 220px; overflow-y: auto; }
    .sds-author-item {
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
        padding: 8px 12px; border: 1.5px solid #dce2d8; border-radius: 12px; background: #fafbf9;
        cursor: pointer; transition: all .15s ease;
    }
    .sds-author-item:has(input:checked) { border-color: var(--g-500); background: var(--g-50); }
    .sds-author-item.is-hidden { display: none; }
    .sds-author-left { display: flex; align-items: center; gap: 10px; font-size: 12.5px; font-weight: 600; min-width: 0; }
    .sds-author-left input { position: absolute; opacity: 0; pointer-events: none; }
    .sds-avatar {
        width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center;
        justify-content: center; flex-shrink: 0; background: #e9eee6; color: var(--ink-2);
        font-size: 11.5px; font-weight: 700;
    }
    .sds-author-item:has(input:checked) .sds-avatar { background: var(--g-500); color: #fff; }
    .sds-author-name { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sds-carnet {
        font-size: 11px; font-weight: 700; color: var(--ink-2); background: #fff;
        border: 1px solid #e1e6de; border-radius: 6px; padding: 2px 7px;
    }

    /* Cuadro punteado que alberga el estado vacío o la imagen seleccionada */
    .sds-dropzone {
        position: relative;
        width: 100%;
        min-height: 210px;
        border: 2px dashed #b9c8b1;
        border-radius: 14px;
        background: #f8fbf5;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: border-color .15s ease, background-color .15s ease;
    }
    .sds-dropzone:hover, .sds-dropzone.is-dragover {
        border-color: var(--g-500);
        background: var(--g-50);
    }
    .sds-dropzone-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-align: center;
        padding: 24px 16px;
    }
    .sds-dropzone-empty.is-hidden {
        display: none;
    }
    .sds-upload-icon {
        width: 40px; height: 40px; border-radius: 11px; display: inline-flex; align-items: center;
        justify-content: center; background: var(--g-100); color: var(--g-700);
    }
    .sds-upload-title { font-size: 13.5px; font-weight: 700; color: var(--g-700); }
    .sds-upload-sub { font-size: 11.5px; color: var(--ink-3); }

    .sds-dropzone-filled {
        position: relative;
        width: 100%;
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #111613;
    }
    .sds-dropzone-filled.is-hidden {
        display: none;
    }
    .sds-dropzone-filled img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .sds-dropzone-bar {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 9px 12px;
        background: rgba(17, 22, 19, 0.78);
        backdrop-filter: blur(4px);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .sds-dropzone-filename {
        font-size: 11.5px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .sds-dropzone-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
    }
    .sds-dz-btn {
        border: 1px solid rgba(255, 255, 255, 0.35);
        background: rgba(255, 255, 255, 0.14);
        color: #ffffff;
        border-radius: 7px;
        padding: 4px 9px;
        font-family: inherit;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color .15s ease;
    }
    .sds-dz-btn:hover {
        background: rgba(255, 255, 255, 0.28);
    }
    .sds-dz-btn.is-danger:hover {
        background: #c92a2a;
        border-color: #c92a2a;
    }
    .sds-upload-error { margin-top: 8px; font-size: 12px; color: var(--danger); font-weight: 500; }
    .sds-upload-error:empty { display: none; }

    .sds-actions-bar {
        margin-top: 24px; padding: 16px 22px;
        background: #ffffff; border: 1px solid var(--line); border-radius: var(--radius);
        display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 14px;
        box-shadow: 0 2px 12px rgba(17, 22, 19, .035);
    }
    .sds-actions-note { font-size: 12px; color: var(--ink-3); }
    .sds-actions-btns { display: flex; align-items: center; gap: 10px; }
    .sds-btn-cancel, .sds-btn-submit {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 11px 20px; border-radius: 12px; font-family: inherit; font-size: 13.5px;
        font-weight: 700; text-decoration: none; cursor: pointer; transition: all .15s ease;
    }
    .sds-btn-cancel { border: 1.5px solid var(--line-2); background: #fff; color: var(--ink); font-weight: 600; }
    .sds-btn-cancel:hover { background: #f4f6f3; }
    .sds-btn-submit {
        border: none; color: #fff; background: linear-gradient(135deg, var(--g-500), var(--g-600));
        box-shadow: 0 4px 12px rgba(111, 165, 43, .3);
    }
    @media (max-width: 640px) {
        .sds-topbar-inner, .sds-main-wrap { padding-left: 16px; padding-right: 16px; }
        .sds-logo-aseis { height: 24px; } .sds-logo-sds { height: 30px; }
        .sds-back-btn span.txt { display: none; }
        .sds-page-header { padding: 18px; } .sds-page-title { font-size: 22px; }
        .sds-card { padding: 18px; }
        .sds-actions-btns { width: 100%; }
        .sds-actions-btns > * { flex: 1; }
    }
</style>
