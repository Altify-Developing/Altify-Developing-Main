// app.js — Full practice logic with Sections (40/40/rest, no repeats), progress, flags,
// review-incorrect, continue-to-next-section, restart-at-section-1, category filter (Full only),
// sign images with click-to-magnify, and keyboard shortcuts.
//
// Compatible with the "minimal start screen" dark index.html you have:
// IDs used: intro, quiz, results, categorySelect, sectionSelect, btnStart,
// qText, choices, explain, pillIndex, pillCat, pillFlag, flagStar, scoreNow, remain,
// sectionLabel, sectionProgress, prog, btnPrev, btnNext, btnSubmit,
// summary, btnNextSection, btnRestartSection1, btnReviewIncorrect, btnStartOver.

(function () {
  // ---------- Utilities ----------
  const $  = (s) => document.querySelector(s);
  const $$ = (s) => Array.from(document.querySelectorAll(s));
  const rand = (n) => Math.floor(Math.random() * n);
  const shuffle = (arr) => { for (let i = arr.length - 1; i > 0; i--) { const j = rand(i + 1); [arr[i], arr[j]] = [arr[j], arr[i]]; } return arr; };

  // Fallback DMVStore if storage.js is missing
  const DMVStore = (window.DMVStore ?? {
    load: () => ({}),
    save: () => {},
    clear: () => {}
  });

  // ---------- DOM ----------
  const els = {
    intro: $("#intro"),
    quiz: $("#quiz"),
    results: $("#results"),

    // Start controls
    catSel: $("#categorySelect"),
    sectionSel: $("#sectionSelect"),
    btnStart: $("#btnStart"),

    // Quiz UI
    qText: $("#qText"),
    choices: $("#choices"),
    explain: $("#explain"),
    pillIndex: $("#pillIndex"),
    pillCat: $("#pillCat"),
    pillFlag: $("#pillFlag"),
    flagStar: $("#flagStar"),
    scoreNow: $("#scoreNow"),
    remain: $("#remain"),
    sectionLabel: $("#sectionLabel"),
    sectionProgress: $("#sectionProgress"),
    prog: $("#prog"),

    btnPrev: $("#btnPrev"),
    btnNext: $("#btnNext"),
    btnSubmit: $("#btnSubmit"),

    // Results
    summary: $("#summary"),
    btnNextSection: $("#btnNextSection"),
    btnRestartSection1: $("#btnRestartSection1"),
    btnReviewIncorrect: $("#btnReviewIncorrect"),
    btnStartOver: $("#btnStartOver"),
  };

  // Guard: if any critical element missing, stop gracefully
  for (const [k, v] of Object.entries(els)) {
    if (!v) {
      console.error(`[DMV] Missing element for key: ${k} (check index.html IDs)`);
    }
  }

  // ---------- State ----------
  const state = {
    master: [],                 // full list shuffled once per page load
    slices: { s1: [], s2: [], s3: [] }, // section slices (no repeats across them)
    pool: [],                   // current run’s questions
    cursor: 0,
    answers: {},                // qid -> selected index
    flags: new Set(),
    correct: new Set(),
    incorrect: new Set(),
    mode: "quiz",               // or "review"
  };

  // ---------- Persistence ----------
  const persisted = DMVStore.load() || {};
  if (persisted.flags) state.flags = new Set(persisted.flags);

  function persist() {
    try {
      DMVStore.save({
        flags: Array.from(state.flags),
        category: els.catSel?.value
      });
    } catch {}
  }

  // ---------- Setup ----------
  function populateCategories() {
    if (!els.catSel) return;
    const cats = Array.from(new Set(QUESTIONS.map(q => q.category))).sort();
    els.catSel.innerHTML = ["All", ...cats].map(c => `<option>${c}</option>`).join("");
    if (persisted.category && cats.includes(persisted.category)) {
      els.catSel.value = persisted.category;
    }
  }

  // Build master and slices (40/40/rest) ONCE per page load
  function buildMasterAndSlices() {
    // one-time shuffle + choice shuffle (stable for this page load)
    state.master = shuffle(QUESTIONS.slice()).map(q => {
      const order = shuffle(q.choices.map((_, i) => i));
      const newChoices = order.map(i => q.choices[i]);
      const newAnswer = order.indexOf(q.answerIndex);
      return { ...q, choices: newChoices, answerIndex: newAnswer };
    });

    state.slices.s1 = state.master.slice(0, 40);
    state.slices.s2 = state.master.slice(40, 80);
    state.slices.s3 = state.master.slice(80);
  }

  // ---------- Quiz Flow ----------
  function startQuiz({ reviewOnly = false, incorrectOnly = false } = {}) {
    // Show quiz / hide others
    show(els.quiz);
    hide(els.results);
    hide(els.intro);

    state.mode = (reviewOnly || incorrectOnly) ? "review" : "quiz";

    const sec = els.sectionSel?.value || "full";
    let source;

    if (reviewOnly) {
      source = state.master.filter(q => state.flags.has(q.id));
    } else if (incorrectOnly) {
      source = state.master.filter(q => state.incorrect.has(q.id));
    } else if (sec === "s1" || sec === "s2" || sec === "s3") {
      // Sections ignore category; use the pre-sliced sets (no repeats between sections)
      source = state.slices[sec].slice();
    } else {
      // Full test respects category selection
      const cat = els.catSel?.value || "All";
      source = (cat === "All") ? state.master.slice() : state.master.filter(q => q.category === cat);
    }

    // Randomize pool order for this run
    state.pool = shuffle(source);
    state.cursor = 0;
    state.answers = {};
    state.correct.clear();
    state.incorrect.clear();
    persist();

    updateMeta();
    renderQuestion();
  }

  function finish() {
    // Hide quiz, show results
    hide(els.quiz);
    show(els.results);

    const total = state.pool.length;
    const score = state.correct.size;
    const pct = Math.round((score / Math.max(1, total)) * 100);
    if (els.summary) els.summary.textContent = `You answered ${score} of ${total} correctly (${pct}%).`;

    // Continue to next section if applicable
    const sec = els.sectionSel?.value || "full";
    let next = null;
    if (sec === "s1") next = "s2";
    else if (sec === "s2") next = "s3";

    if (els.btnNextSection) {
      if (next) {
        els.btnNextSection.classList.remove("hidden");
        els.btnNextSection.textContent = `Continue to Section ${next.slice(1)}`;
        els.btnNextSection.onclick = () => {
          if (els.sectionSel) els.sectionSel.value = next;
          startQuiz();
        };
      } else {
        els.btnNextSection.classList.add("hidden");
      }
    }
  }

  function updateMeta() {
    const total = state.pool.length || 1;
    if (els.pillIndex) els.pillIndex.textContent = `Question ${state.cursor + 1}/${total}`;
    if (els.prog) { els.prog.max = total; els.prog.value = state.cursor + 1; }
    if (els.remain) els.remain.textContent = (total - state.cursor - 1);

    const q = state.pool[state.cursor];
    if (els.pillCat) els.pillCat.textContent = `Category: ${q?.category ?? "-"}`;
    if (els.scoreNow) els.scoreNow.textContent = `Score: ${state.correct.size}`;

    updateFlagUI();
    updateSectionUI();
  }

  function updateFlagUI() {
    const q = state.pool[state.cursor];
    const flagged = q && state.flags.has(q.id);
    if (els.flagStar) els.flagStar.textContent = flagged ? "★" : "☆";
  }

  function updateSectionUI() {
    const sec = els.sectionSel?.value || "full";
    let label = "Full Test";
    if (sec === "s1") label = "Section 1 of 3";
    else if (sec === "s2") label = "Section 2 of 3";
    else if (sec === "s3") label = "Section 3 of 3";

    if (els.sectionLabel) els.sectionLabel.textContent = label;
    if (els.sectionProgress) els.sectionProgress.textContent = `Progress: ${state.cursor + 1} / ${state.pool.length || 0}`;
  }

  function renderQuestion() {
    const q = state.pool[state.cursor];
    if (!q) return;

    // Remove any previous sign image
    $$(".sign-img").forEach(n => n.remove());

    // Insert sign image ABOVE question text
    if (q.image && els.qText) {
      const img = document.createElement("img");
      img.src = q.image;
      img.alt = "Question image";
      img.className = "sign-img";
      // Default size
      let size = 140;
      // Make blue/green signs bigger by default
      if (q.id === "sign-013" || q.id === "sign-014") size = 210;

      img.style.width = size + "px";
      img.style.height = size + "px";
      img.style.objectFit = "contain";
      img.style.display = "block";
      img.style.margin = "0 auto 14px auto";

      // Magnify on click
      attachMagnify(img);

      // Insert before the question text element
      els.qText.parentNode.insertBefore(img, els.qText);
    }

    // Text & explanation
    els.qText.textContent = q.q;
    els.explain.classList.add("hidden");
    els.explain.textContent = q.explanation ?? "";

    // Choices
    els.choices.innerHTML = "";
    q.choices.forEach((text, idx) => {
      const btn = document.createElement("button");
      btn.className = "choice";
      btn.innerHTML = `<b>${idx + 1}.</b> ${text}`;
      btn.addEventListener("click", () => choose(idx));
      els.choices.appendChild(btn);
    });

    // Restore any previous selection
    const prev = state.answers[q.id];
    if (typeof prev === "number") scoreVisual(prev);

    updateMeta();
  }

  function choose(idx) {
    const q = state.pool[state.cursor];
    if (!q) return;
    state.answers[q.id] = idx;
    if (idx === q.answerIndex) { state.correct.add(q.id); state.incorrect.delete(q.id); }
    else { state.incorrect.add(q.id); state.correct.delete(q.id); }

    scoreVisual(idx);
    els.explain.classList.remove("hidden");
    if (els.scoreNow) els.scoreNow.textContent = `Score: ${state.correct.size}`;
  }

  function scoreVisual(selectedIdx) {
    const q = state.pool[state.cursor];
    $$("#choices .choice").forEach((n, i) => {
      n.classList.remove("selected", "correct", "incorrect");
      if (i === selectedIdx) n.classList.add("selected");
      if (i === q.answerIndex) n.classList.add("correct");
      if (i === selectedIdx && i !== q.answerIndex) n.classList.add("incorrect");
    });
  }

  function next() {
    if (state.cursor < state.pool.length - 1) {
      state.cursor++;
      renderQuestion();
    } else {
      finish();
    }
  }

  function prev() {
    if (state.cursor > 0) {
      state.cursor--;
      renderQuestion();
    }
  }

  function toggleFlag() {
    const q = state.pool[state.cursor];
    if (!q) return;
    if (state.flags.has(q.id)) state.flags.delete(q.id);
    else state.flags.add(q.id);
    persist();
    updateFlagUI();
  }

  // ---------- Image Magnify ----------
  function attachMagnify(img) {
    let enlarged = false;
    img.style.cursor = "zoom-in";
    img.style.transition = "transform 0.22s ease";
    img.addEventListener("click", () => {
      enlarged = !enlarged;
      if (enlarged) {
        img.style.transform = "scale(1.9)";
        img.style.cursor = "zoom-out";
      } else {
        img.style.transform = "scale(1)";
        img.style.cursor = "zoom-in";
      }
    });
  }

  // ---------- Visibility helpers ----------
  function show(el) { if (el) el.style.display = (el === els.quiz ? "block" : "block"); }
  function hide(el) { if (el) el.style.display = "none"; }

  // ---------- Event Bindings ----------
  if (els.btnStart) els.btnStart.addEventListener("click", () => startQuiz());
  if (els.btnPrev)  els.btnPrev.addEventListener("click", prev);
  if (els.btnNext)  els.btnNext.addEventListener("click", next);
  if (els.btnSubmit) els.btnSubmit.addEventListener("click", finish);

  if (els.btnStartOver) els.btnStartOver.addEventListener("click", () => {
    // Return to minimal start screen without reloading
    hide(els.quiz);
    hide(els.results);
    show(els.intro);
  });

  if (els.btnRestartSection1) els.btnRestartSection1.addEventListener("click", () => {
    if (els.sectionSel) els.sectionSel.value = "s1";
    startQuiz();
  });

  if (els.btnReviewIncorrect) els.btnReviewIncorrect.addEventListener("click", () => {
    startQuiz({ incorrectOnly: true });
  });

  if (els.pillFlag) els.pillFlag.addEventListener("click", toggleFlag);

  // Keyboard shortcuts (1–4 to answer; N/P to nav; F to flag)
  window.addEventListener("keydown", (e) => {
    const k = e.key.toLowerCase();
    if (["1", "2", "3", "4"].includes(k)) {
      const idx = Number(k) - 1;
      const nodes = $$("#choices .choice");
      if (nodes[idx]) nodes[idx].click();
    } else if (k === "n") {
      if (els.quiz?.style.display !== "none") next();
    } else if (k === "p") {
      if (els.quiz?.style.display !== "none") prev();
    } else if (k === "f") {
      if (els.quiz?.style.display !== "none") toggleFlag();
    }
  });

  // ---------- Init ----------
  function init() {
    populateCategories();
    buildMasterAndSlices(); // Prepares section slices (no repeats across them)
    // Initial visibility (minimal start screen)
    show(els.intro);
    hide(els.quiz);
    hide(els.results);
  }
  init();
})();
