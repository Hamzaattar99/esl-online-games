class GameEngine {
    constructor(config) {
        this.data = config.data || [];
        this.settings = config.settings || {};

        this.current = 0;
        this.score = 0;
        this.correct = 0;
        this.wrong = 0;

        this.timer = this.settings.timer || 0;
        this.interval = null;

        this.onFinish = config.onFinish || function () {};
    }

    startTimer(updateUI, finishCallback) {
        if (!this.timer) return;

        let time = this.timer;

        this.interval = setInterval(() => {
            time--;
            updateUI(time);

            if (time <= 0) {
                clearInterval(this.interval);
                finishCallback();
            }
        }, 1000);
    }

    stopTimer() {
        clearInterval(this.interval);
    }

    answer(isCorrect) {
        if (isCorrect) {
            this.score += 10;
            this.correct++;
        } else {
            this.wrong++;
        }

        this.current++;
    }

    progress() {
        return (this.current / this.data.length) * 100;
    }

    isFinished() {
        return this.current >= this.data.length;
    }

    result() {
        return {
            score: this.score,
            correct: this.correct,
            wrong: this.wrong,
            total: this.data.length
        };
    }
}