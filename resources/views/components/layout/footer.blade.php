<footer class="block">Footer</footer>

@stack('footerScript')


@stack('footerStyle')

<x-notice />

<script>
    function vy_timer(fCb, eCb, expiry, format = 'd:h:m:s') {

        return {
            expiry: expiry,
            format: format,
            remaining: null,
            timeLeft: null,
            init() {
                this.setRemaining();
                fCb(this.timeLeft);
                let interval = setInterval(() => {
                    this.setRemaining();
                    fCb(this.timeLeft);

                    if (this.events().finished) {
                        eCb();
                        clearInterval(interval);
                    }
                }, 1000);
            },
            setRemaining() {
                const diff = this.expiry - new Date().getTime();
                this.remaining = parseInt(diff / 1000);
                this.setFormat();
            },
            setFormat() {
                let formatMap = this.format.split(':').map(f => this.time(f));
                this.timeLeft = formatMap.join(':');
            },
            days() {
                return {
                    value: this.remaining / 86400,
                    remaining: this.remaining % 86400
                };
            },
            hours() {
                return {
                    value: this.days().remaining / 3600,
                    remaining: this.days().remaining % 3600
                };
            },
            minutes() {
                return {
                    value: this.hours().remaining / 60,
                    remaining: this.hours().remaining % 60
                };
            },
            seconds() {
                return {
                    value: this.minutes().remaining,
                };
            },
            events() {
                return {
                    finished: this.remaining <= 0,
                };
            },
            padStart(value) {
                return parseInt(value).toString().padStart(2, '0');
            },
            time(f) {
                switch (f) {
                    case 'd':
                        return this.padStart(this.days().value);
                        break;
                    case 'h':
                        return this.padStart(this.hours().value);
                        break;
                    case 'm':
                        return this.padStart(this.minutes().value);
                        break;
                    case 's':
                        return this.padStart(this.seconds().value);
                        break;
                    default:
                        break;
                }
            },
        }
    }





    function vy_fetch(data, url, method = "POST") {
        let errorText = "خطایی رخ داد، صفحه را رفرش کنید.";
        return new Promise((resolve, reject) => {
            fetch(url, {
                    method: method,
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => {
                    response.json().then((body) => {
                        if (response.ok) {
                            resolve(body)
                        } else {
                            body.body = body.body || errorText;
                            reject(body)
                        }
                    })
                })
                .catch((error) => {
                    reject(error)
                })
        })
    }
</script>