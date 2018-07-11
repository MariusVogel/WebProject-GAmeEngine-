function starteSpiel() {
    document.getElementById('startbutton').style.display = 'none';
    document.body.style.backgroundImage = 'none';
    var config = {
        type: Phaser.AUTO,
        width: 1920,
        height: 1080,
        physics: {
            default: 'arcade',
            arcade: {
                gravity: {y: 1000},
                debug: false
            }
        },
        scene: {
            init: init,
            preload: preload,
            create: create,
            update: update
        }
    };

    var platforms;
    var player;
    var cursors;
    var score = 0;
    var scoreText;
    var stars;
    var music;
    var game = new Phaser.Game(config);

    function init() {
        var canvas = this.sys.game.canvas;
    }

    function preload() {
        this.alive = true;
        this.load.image('background', '../src/assets/background.png');
        this.load.image('ground', '../src/assets/platform.png');
        this.load.image('star', '../src/assets/star.png');
        this.load.image('scorebar', '../src/assets/ScoreBar.png');
        this.load.spritesheet('dude',
            '../src/assets/dude.png',
            {frameWidth: 32, frameHeight: 48}
        );
        this.load.image('slime', '../src/assets/slime.png');
        this.load.audio('starPick', '../src/assets/sound/Coin.ogg');
        this.load.image('soundOn', '../src/assets/soundOn.png');
        this.load.image('soundOff', '../src/assets/soundOFF.png');
        this.load.audio('gameMusic', ['../src/assets/music/SF.mp3', '../src/assets/music/SF.ogg']);
    }

    function create() {
        this.add.image(1050, 700, 'background').setScale(2);

        platforms = this.physics.add.staticGroup();

        platforms.create(0, 1048, 'ground');
        platforms.create(398, 1048, 'ground');
        platforms.create(794, 1048, 'ground');
        platforms.create(1190, 1048, 'ground');
        platforms.create(1582, 1048, 'ground');
        platforms.create(1800, 1048, 'ground');

        platforms.create(350, 850, 'ground');
        platforms.create(650, 850, 'ground');
        platforms.create(1200, 850, 'ground');
        platforms.create(1600, 850, 'ground');

        platforms.create(950, 650, 'ground');
        platforms.create(1800, 650, 'ground');
        platforms.create(0, 650, 'ground');

        platforms.create(450, 475, 'ground');
        platforms.create(1200, 475, 'ground');
        platforms.create(1800, 475, 'ground');

        platforms.create(50, 350, 'ground');
        platforms.create(750, 320, 'ground');
        platforms.create(1400, 300, 'ground');


        player = this.physics.add.sprite(500, 500, 'dude');

        //Camera

        //Nur hier die Werte anpassen wenn die Kamera zu Groß oder zu Klein ist!
        this.cameras.main.setSize(800, 600);

        this.cameras.main.setBounds(0, 0, 1920, 1060);
        this.physics.world.setBounds(0, 0, 1920, 1060);

        this.cameras.main.startFollow(player);


        //player.setBounce(0.2);
        player.setCollideWorldBounds(true);

        this.anims.create({
            key: 'left',
            frames: this.anims.generateFrameNumbers('dude', {start: 0, end: 3}),
            frameRate: 10,
            repeat: -1
        });

        this.anims.create({
            key: 'turn',
            frames: [{key: 'dude', frame: 4}],
            frameRate: 20
        });

        this.anims.create({
            key: 'right',
            frames: this.anims.generateFrameNumbers('dude', {start: 5, end: 8}),
            frameRate: 10,
            repeat: -1
        });

        cursors = this.input.keyboard.createCursorKeys();

        stars = this.physics.add.group({
            key: 'star',
            repeat: 19,
            setXY: {x: 12, y: 300, stepX: 100}
        });

        stars.children.iterate(function (child) {

            child.setBounceY(Phaser.Math.FloatBetween(0.4, 0.8));

        });

        this.add.image(120, 45, 'scorebar').setScrollFactor(0);
        scoreText = this.add.text(30, 30, 'Score:0', {fontSize: '32px', fill: '#FFCD00', align: "center"});
        scoreText.setScrollFactor(0);


        // hier könnten wir noch einen mute button einbauen...
        // problem ist, findet mal phaser 3 ewrkläuterung zu klickbaren buttons :D
        // mrmute =  this.physics.add.staticGroup();
        // mrmute.create(25,50,'soundOn').setScrollFactor(0);
        //mrmute.inputEnabled = true;
        //mrmute.oninput
        //this.image.input.on('mrmute',this.listener)
        //mrmute.events.onInputDown.add(listener,this);

        this.physics.add.collider(player, platforms);
        this.physics.add.collider(stars, platforms);

        this.physics.add.overlap(player, stars, collectStar, null, this);

        slimes = this.physics.add.group();

        this.physics.add.collider(slimes, platforms);

        this.physics.add.collider(player, slimes, getHit, null, this);

        music = game.sound.add('gameMusic');

        music.play();

    }


    function update() {
        if (!this.alive) {
            return;
        }
        if (cursors.left.isDown) {
            player.setVelocityX(-200);

            player.anims.play('left', true);
        }
        else if (cursors.right.isDown) {
            player.setVelocityX(200);

            player.anims.play('right', true);
        }
        else {
            player.setVelocityX(0);

            player.anims.play('turn');
        }

        if (cursors.up.isDown && player.body.touching.down) {
            player.setVelocityY(-666);
        }

        // if (cursors.isDown(82)){
        //   this.scene.restart();
        //}

    }


    function collectStar(player, star) {
        star.disableBody(true, true);

        var sound = this.sound.add('starPick');

        sound.play();

        score += 10;
        scoreText.setText('Score:' + score);
        stars = this.physics.add.group({
            key: 'star',
            setXY: {x: (Math.random() * 1920), y: (Math.random() * 600)}
        });
        this.physics.add.collider(stars, platforms);
        this.physics.add.overlap(player, stars, collectStar, null, this);
        //}
        if (score % 50 === 0) {
            var slime = slimes.create((Math.random() * 1920), 16, 'slime');
            slime.setBounce(Phaser.Math.Between(0.5, 1));
            slime.setCollideWorldBounds(true);
            slime.setVelocity(Phaser.Math.Between(-200, 200), 50);
            slime.allowGravity = false;
        }
    }

    function getHit(player, slime) {
        this.physics.pause();

        player.anims.play('turn');

        music.stop();

        $.post("../src/score.php", {'score': score}).done(function () {
           window.location = "highscore.php?score=" + score;
        });
    }
}