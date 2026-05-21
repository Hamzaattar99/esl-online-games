class GameEngine {

    constructor(config){

        this.data = config.data || [];
        this.settings = config.settings || {};

        this.current = 0;

        this.score = 0;

        this.correct = 0;

        this.wrong = 0;

        this.answers = [];

        this.startTime = Date.now();

    }

    answer(question, selected, correct){

        const isCorrect = selected === correct;

        this.answers.push({
            question,
            selected,
            correct,
            isCorrect
        });

        if(isCorrect){

            this.score += 10;
            this.correct++;

        }else{

            this.wrong++;

        }

        this.current++;

        return isCorrect;

    }

    progress(){

        return (
            this.current /
            this.data.length
        ) * 100;

    }

    result(contentId, playerName){

        return {

            content_id: contentId,

            player_name: playerName,

            score: this.score,

            correct: this.correct,

            wrong: this.wrong,

            total: this.data.length,

            time_taken: Math.floor(
                (Date.now() - this.startTime) / 1000
            ),

            answers: this.answers

        };

    }

}