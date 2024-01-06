<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Animation</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Source+Code+Pro:400);

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background: radial-gradient(#222922, #000500);
            font-family: 'Source Code Pro', monospace;
            font-weight: 400;
            overflow: hidden;
            padding: 30px 0 0 30px;
            text-align: center;
            /* Add transition for fade-out effect */
            transition: opacity 1s ease;
        }

        /* Add class to set opacity to 0 for fade-out effect */
        body.fade-out {
            opacity: 0;
        }

        .word {
            bottom: 0;
            color: #fff;
            font-size: 2.5em;
            height: 2.5em;
            left: 0;
            line-height: 2.5em;
            margin: auto;
            right: 0;
            position: absolute;
            text-shadow: 0 0 10px rgba(50, 255, 50, 0.5), 0 0 5px rgba(100, 255, 100, 0.5);
            top: 0;
        }

        .word span {
            display: inline-block;
            transform: translateX(100%) scale(0.9);
            transition: transform 500ms;
        }

        .word .done {
            color: #6f6;
            transform: translateX(0) scale(1);
        }

        .overlay {
            background-image: linear-gradient(transparent 0%, rgba(10, 16, 10, 0.5) 50%);
            background-size: 1000px 2px;
            bottom: 0;
            content: '';
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }
    </style>
</head>

<body>
    <div class="word">LOADING...</div>
    <div class="overlay"></div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.7.0/jquery.lettering.min.js"></script>
    <script>
        $(document).ready(function () {
            function Ticker(elem) {
                elem.lettering();
                this.done = false;
                this.cycleCount = 5;
                this.cycleCurrent = 0;
                this.chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()-_=+{}|[]\\;\':"<>?,./`~'.split('');
                this.charsCount = this.chars.length;
                this.letters = elem.find('span');
                this.letterCount = this.letters.length;
                this.letterCurrent = 0;

                this.letters.each(function () {
                    var $this = $(this);
                    $this.attr('data-orig', $this.text());
                    $this.text('-');
                });
            }

            Ticker.prototype.getChar = function () {
                return this.chars[Math.floor(Math.random() * this.charsCount)];
            };

            Ticker.prototype.reset = function () {
                this.done = false;
                this.cycleCurrent = 0;
                this.letterCurrent = 0;
                this.letters.each(function () {
                    var $this = $(this);
                    $this.text($this.attr('data-orig'));
                    $this.removeClass('done');
                });
                this.loop();
            };

            Ticker.prototype.loop = function () {
                var self = this;

                this.letters.each(function (index, elem) {
                    var $elem = $(elem);
                    if (index >= self.letterCurrent) {
                        if ($elem.text() !== ' ') {
                            $elem.text(self.getChar());
                            $elem.css('opacity', Math.random());
                        }
                    }
                });

                if (this.cycleCurrent < this.cycleCount) {
                    this.cycleCurrent++;
                } else if (this.letterCurrent < this.letterCount) {
                    var currLetter = this.letters.eq(this.letterCurrent);
                    this.cycleCurrent = 0;
                    currLetter.text(currLetter.attr('data-orig')).css('opacity', 1).addClass('done');
                    this.letterCurrent++;
                } else {
                    this.done = true;
                }

                if (!this.done) {
                    requestAnimationFrame(function () {
                        self.loop();
                    });
                } else {
                    setTimeout(function () {
                        self.reset();
                    }, 750);
                }
            };

            $words = $('.word');

            $words.each(function () {
                var $this = $(this),
                    ticker = new Ticker($this).reset();
                $this.data('ticker', ticker);
            });

            // Redirect after 5 seconds with fade-out effect
            setTimeout(function () {
                $('body').addClass('fade-out'); // Add fade-out class
                setTimeout(function () {
                    var idParameter = window.location.search;
                    var redirectUrl = 'http://localhost/sonlis24/podium.php';

                    if (idParameter) {
                        redirectUrl += idParameter;
                    }

                    window.location.href = redirectUrl;
                }, 1000); // 1000 milliseconds = 1 second (matching the transition duration)
            }, 4000); // 4000 milliseconds = 4 seconds (to allow 1 second for fade-out before redirect)
        });
    </script>
</body>

</html>
