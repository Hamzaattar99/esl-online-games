class GameEngine{

    constructor(config = {}){

        this.data =
        config.data || [];

        this.settings =
        config.settings || {};

        this.current = 0;

        this.score = 0;

        this.correct = 0;

        this.wrong = 0;

        this.answers = [];

        this.startTime =
        Date.now();

    }

    answer(question, selected, correct){

        const isCorrect =
        selected === correct;

        this.answers.push({

            question,
            selected,
            correct,
            isCorrect

        });

        if(isCorrect){

            this.correct++;
            this.score += 10;

            this.playSound(
                "correct"
            );

        }else{

            this.wrong++;

            this.playSound(
                "wrong"
            );

        }

        this.current++;

        return isCorrect;

    }

    playSound(type){

        try{

            const audio =
            new Audio(
                type === "correct"
                ? "assets/sounds/correct.mp3"
                : "assets/sounds/wrong.mp3"
            );

            audio.volume = 0.4;

            audio.play();

        }catch(err){}
    }

    progress(){

        return Math.floor(
            (
                this.current /
                this.data.length
            ) * 100
        );

    }

    getElapsedTime(){

        return Math.floor(
            (
                Date.now() -
                this.startTime
            ) / 1000
        );

    }

    result(playerName = "Guest"){

        return {

            content_id:
            window.gameContent.id,

            player_name:
            playerName,

            score:
            this.score,

            correct_answers:
            this.correct,

            wrong_answers:
            this.wrong,

            answers_json:
            JSON.stringify(
                this.answers
            ),

            time_taken:
            this.getElapsedTime()

        };

    }

}