// realstyle.js — Real DMV-style exam: 46 questions, timed, 80% to pass
(function () {
  const $ = (s) => document.querySelector(s);
  const $$ = (s) => Array.from(document.querySelectorAll(s));
  const rand = (n) => Math.floor(Math.random() * n);
  const shuffle = (arr) => { for (let i = arr.length - 1; i > 0; i--) { const j = rand(i + 1); [arr[i], arr[j]] = [arr[j], arr[i]]; } return arr; };

  const EXAM_LEN = 46;
  const PASS_PCT = 0.80;              // 80% needed
  const REQUIRED = Math.ceil(EXAM_LEN * PASS_PCT); // 37

  const els = {
    timer: $("#timer"),
    quizScreen: $("#quizScreen"),
    resultScreen: $("#resultScreen"),
    qText: $("#qText"),
    choices: $("#choices"),
    nextBtn: $("#nextBtn"),
    resultTitle: $("#resultTitle"),
    scoreLine: $("#scoreLine"),
    reviewBtn: $("#reviewBtn"),
    retryBtn: $("#retryBtn"),
  };

  const state = {
    pool: [],
    cursor: 0,
    answers: {},             // qid -> selected index
    correct: new Set(),
    incorrect: new Set(),
    seconds: 30 * 60,        // default 30:00 (REALSTYLE.html shows static 30:00)
    timerId: null,
    finished: false,
    reviewing: false,
  };

  function formatTime(sec) {
    const m = Math.max(0, Math.floor(sec / 60));
    const s = Math.max(0, sec % 60);
    return `${String(m).padStart(2, "0")}:${String(s).padStart(2, "0")}`;
  }

  function startTimer() {
    stopTimer();
    tick();
    state.timerId = setInterval(tick, 1000);
  }
  function stopTimer() {
    if (state.timerId) { clearInterval(state.timerId); state.timerId = null; }
  }
  function tick() {
    els.timer.textContent = `Time: ${formatTime(state.seconds)}`;
    if (state.seconds <= 0) {
      stopTimer();
      if (!state.finished) submit();
      return;
    }
    state.seconds--;
  }

  function begin() {
    state.finished = false;
    state.reviewing = false;
    state.seconds = 30 * 60; // fixed 30:00 per your request

    // Build randomized 46-question exam from full pool
    const master = shuffle(QUESTIONS.slice());
    state.pool = master.slice(0, EXAM_LEN).map((q) => {
      const order = shuffle(q.choices.map((_, i) => i));
      const newChoices = order.map((i) => q.choices[i]);
      const newAnswer = order.indexOf(q.answerIndex);
      return { ...q, choices: newChoices, answerIndex: newAnswer };
    });

    state.cursor = 0;
    state.answers = {};
    state.correct.clear();
    state.incorrect.clear();

    els.resultScreen.style.display = "none";
    els.quizScreen.style.display = "block";

    render();
    startTimer();
  }

  function render() {
    const q = state.pool[state.cursor];
    if (!q) return;

    // image (if any) goes ABOVE the question text
    // REALSTYLE.html has no dedicated <img>, so we inject above qText:
    // Remove any old image
    $$(".sign-img").forEach((n) => n.remove());
    if (q.image) {
      const img = document.createElement("img");
      img.src = q.image;
      img.alt = "Question image";
      img.className = "sign-img";
      els.qText.parentNode.insertBefore(img, els.qText);
    }

    els.qText.textContent = q.q;
    els.choices.innerHTML = "";

    q.choices.forEach((text, idx) => {
      const btn = document.createElement("button");
      btn.className = "choice";
      btn.type = "button";
      btn.innerHTML = `<b>${idx + 1}.</b> ${text}`;
      btn.addEventListener("click", () => choose(idx));
      els.choices.appendChild(btn);
    });

    const prev = state.answers[q.id];
    if (typeof prev === "number") paintSelection(prev);

    // Button label: “Next →” or “Submit”
    if (state.cursor === state.pool.length - 1) {
      els.nextBtn.textContent = "Submit";
    } else {
      els.nextBtn.textContent = "Next →";
    }
  }

  function paintSelection(selectedIdx) {
    const nodes = $$("#choices .choice");
    nodes.forEach((n, i) => {
      n.classList.toggle("selected", i === selectedIdx);
    });
  }

  function choose(idx) {
    const q = state.pool[state.cursor];
    state.answers[q.id] = idx;
    paintSelection(idx);
  }

  function next() {
    if (state.cursor < state.pool.length - 1) {
      state.cursor++;
      render();
    } else {
      submit();
    }
  }

  function submit() {
    stopTimer();
    state.finished = true;

    state.correct.clear();
    state.incorrect.clear();

    for (const q of state.pool) {
      const chosen = state.answers[q.id];
      if (typeof chosen === "number" && chosen === q.answerIndex) state.correct.add(q.id);
      else state.incorrect.add(q.id);
    }

    const total = state.pool.length;
    const score = state.correct.size;
    const pct = Math.round((score / Math.max(1, total)) * 100);
    const passed = score >= REQUIRED;

    els.quizScreen.style.display = "none";
    els.resultScreen.style.display = "block";
    els.resultTitle.textContent = passed ? "PASS" : "FAIL";
    els.resultTitle.className = passed ? "result-pass" : "result-fail";
    els.scoreLine.innerHTML =
      `Score: <b>${score}/${total}</b> (${pct}%). ` +
      `You needed at least <b>${REQUIRED}</b> correct to pass (80%).`;
  }

  function reviewIncorrect() {
    // Replace the current pool with just the incorrect ones; show with feedback
    const missed = state.pool.filter((q) => state.incorrect.has(q.id));
    if (!missed.length) {
      alert("Nice! No incorrect questions to review.");
      return;
    }
    state.pool = missed.map((q) => ({ ...q })); // copy
    state.cursor = 0;
    state.answers = {};
    state.reviewing = true;

    els.resultScreen.style.display = "none";
    els.quizScreen.style.display = "block";
    renderWithExplanations();
  }

  function renderWithExplanations() {
    const q = state.pool[state.cursor];
    if (!q) return;

    // image
    $$(".sign-img").forEach((n) => n.remove());
    if (q.image) {
      const img = document.createElement("img");
      img.src = q.image;
      img.alt = "Question image";
      img.className = "sign-img";
      els.qText.parentNode.insertBefore(img, els.qText);
    }

    els.qText.textContent = q.q;
    els.choices.innerHTML = "";

    q.choices.forEach((text, idx) => {
      const btn = document.createElement("button");
      btn.className = "choice";
      btn.type = "button";
      btn.innerHTML = `<b>${idx + 1}.</b> ${text}`;
      const isCorrect = idx === q.answerIndex;
      btn.style.borderColor = isCorrect ? "#2ecc71" : "#ccc";
      if (isCorrect) btn.style.background = "#eafaf0";
      els.choices.appendChild(btn);
    });

    // Show explanation beneath
    const expl = document.createElement("div");
    expl.style.marginTop = "10px";
    expl.style.fontStyle = "italic";
    expl.textContent = q.explanation || "";
    els.choices.appendChild(expl);

    if (state.cursor === state.pool.length - 1) {
      els.nextBtn.textContent = "Back to Results";
      els.nextBtn.onclick = () => {
        els.quizScreen.style.display = "none";
        els.resultScreen.style.display = "block";
        els.nextBtn.onclick = next; // restore
      };
    } else {
      els.nextBtn.textContent = "Next →";
      els.nextBtn.onclick = nextReviewStep;
    }
  }

  function nextReviewStep() {
    if (state.cursor < state.pool.length - 1) {
      state.cursor++;
      renderWithExplanations();
    } else {
      els.quizScreen.style.display = "none";
      els.resultScreen.style.display = "block";
      els.nextBtn.onclick = next;
    }
  }

  // Wire up
  $("#nextBtn").addEventListener("click", () => {
    if (state.reviewing) {
      nextReviewStep();
    } else {
      next();
    }
  });
  $("#reviewBtn").addEventListener("click", reviewIncorrect);
  $("#retryBtn").addEventListener("click", begin);

  // Keyboard shortcuts: 1–4 to select, n=next
  window.addEventListener("keydown", (e) => {
    const k = e.key.toLowerCase();
    if (["1", "2", "3", "4"].includes(k)) {
      const idx = Number(k) - 1;
      const nodes = $$("#choices .choice");
      if (nodes[idx]) nodes[idx].click();
    } else if (k === "n") {
      $("#nextBtn").click();
    }
  });

  // Auto-begin when REALSTYLE loads (click “Begin Test” feel without button)
  begin();
})();
