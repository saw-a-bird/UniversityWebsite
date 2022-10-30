let carousel = (el, parameter) => {
    el = el !==undefined ? el : "";
    parameter = parameter !== undefined ? parameter : {};
    let method = {
        transition: parameter.transition !== undefined ? parameter.transition : null,
        responsive: parameter.grid !== undefined ? parameter.grid : null,
        pagination: parameter.pagination !== undefined ? parameter.pagination : false,
        autoplay: parameter.autoplay !== undefined ? parameter.autoplay : null,
        playTimer: parameter.autoplay !== undefined && parameter.autoplay.playTimer !== undefined
            ? parameter.autoplay.playTimer
            : 2000,
    },trigger = document.querySelectorAll(".carousel-slider"+el);
    Array.prototype.forEach.call(trigger, function (el) {
        
    let content = el.querySelector (".carousel-content"),
        count = content.childElementCount,
        responsive = method.responsive || JSON.parse (content.getAttribute ("data-grid")),
        widths,
        d_widths = el.offsetWidth,
        c_widths = d_widths * count,
        autoplay = method.autoplay || el.getAttribute ("data-autoplay"),
        autoplay_timer = method.playTimer || el.getAttribute ("data-timer"),
        is_pagination = method.pagination || content.getAttribute ("data-pagination"),
        config = {
            "lg": 1024,
            "md": 768,
            "sm": 667
        },
        step,
        pagination_content = el.querySelector (".carousel-pagination");

    content.firstElementChild.classList.add ("active");
    content.style.transitionDuration = method.transition || "500ms";
    this.autoplayEffect = null;

    let index_settings = () => {//tabindexleri slide itemlerine aktarıyoruz
        let slides = content.querySelectorAll (".slide-item");
        for (i in slides) {
            slides[ i ].tabIndex = i;
        }
    }, size = (widths) => {
        let item_resize = el.querySelectorAll (".slide-item");
        Array.prototype.forEach.call (item_resize, (item_size) => {
            item_size.style.width = widths + "px";
        });
    }, responsive_grid = () => {
        if (responsive) {
            if (window.innerWidth >= config.lg) {
                if (responsive.xl !== undefined) {
                    gridCount = responsive.xl;
                    widths = Number (d_widths) / Number (gridCount);
                }
            } else if (window.innerWidth >= config.md) {
                if (responsive.lg !== undefined) {
                    gridCount = responsive.lg;
                    widths = Number (d_widths) / Number (gridCount);
                    console.log (d_widths, gridCount, responsive)
                }
            } else if (window.innerWidth >= config.sm) {
                if (responsive.md !== undefined) {
                    gridCount = responsive.md;
                    widths = Number (d_widths) / Number (gridCount);
                }
            } else if (window.innerWidth < config.sm) {
                if (responsive.sm !== undefined) {
                    gridCount = responsive.sm;
                    widths = Number (d_widths) / Number (gridCount);
                }
            }
        } else {
            widths = d_widths;
        }
        size (widths);
        c_widths = widths * content.lastElementChild.tabIndex;
        content.style.minWidth = c_widths;
        return widths;
    };

    let autoplay_ = () => {
        if (autoplay) {
            let i = 0;
            let last_i = content.lastElementChild.tabIndex;
            this.autoplayEffect = setInterval (() => {
                if (last_i > i) {
                    content.style.transform = "translate3d(-" + d_widths * i + "px,0px,0px)";
                    content.children.item (i + 1).classList.add ("active");
                    content.children.item (i).classList.remove ("active");
                } else {
                    content.lastElementChild.classList.remove ("active");
                    content.firstElementChild.classList.add ("active");
                    content.style.transform = "translate3d(" + 0 + "px,0px,0px)";

                    i = 0;
                }
                i++;
            }, Number (autoplay_timer));
        }
    }, pagination = () => {
        if (is_pagination) {
            let pagination_item = el.querySelector (".carousel-pagination");
            for (let i = 0; i < count; i++) {
                let p_item = document.createElement ("a");
                p_item.href = "#!";
                p_item.classList.add ("item");
                p_item.tabIndex = i;
                pagination_item.appendChild (p_item);
            }
            pagination_content.firstElementChild.classList.add ("active");
        }
    }, slider_next = (el) => {
        let content = el.querySelector (".carousel-content");
        let last_i = content.lastElementChild.tabIndex;
        let i = content.querySelector (".slide-item.active").tabIndex + 1;
        step = d_widths / responsive_grid ();
        widths = d_widths / step;
        if (step > 1) {
            last_i = last_i - step + 1;
        }
        if (i <= last_i) {
            content.children.item (i).classList.add ("active");
            content.children.item (i - 1).classList.remove ("active");
            pagination_content.children.item (i).classList.add ("active");
            pagination_content.children.item (i - 1).classList.remove ("active");
            let ml_ = widths * i;
            content.style.transform = "translate3d(-" + ml_ + "px,0px,0px)";
            i++;
        } else {
            i = 1;
            content.lastElementChild.classList.remove ("active");
            content.firstElementChild.classList.add ("active");
            pagination_content.lastElementChild.classList.remove ("active");
            pagination_content.firstElementChild.classList.add ("active");
            content.style.transform = "translate3d(" + 0 + "px,0px,0px)";
        }
    }, slider_prev = () => {
        let content = el.querySelector (".carousel-content");
        let last_i = content.lastElementChild.tabIndex;
        let i = content.querySelector (".slide-item.active").tabIndex;
        step = d_widths / responsive_grid ();
        widths = d_widths / step;
        if (i >= 1) {
            content.children.item (i - 1).classList.add ("active");
            content.children.item (i).classList.remove ("active");
            i--;
            let ml_ = widths * i;
            content.style.transform = "translate3d(-" + ml_ + "px,0px,0px)";
        } else {
            i = last_i;
            content.lastElementChild.classList.add ("active");
            content.firstElementChild.classList.remove ("active");
            if (step > 1) {
                last_i = last_i - step + 1;
            }
            let ml_ = widths * ( last_i - 1 );
            content.style.transform = "translate3d(-" + ml_ + "px,0px,0px)";
            i--;
        }

    }, slider_direction = (el) => {
        let prev = el.querySelector (".carousel-prev-btn");
        let next = el.querySelector (".carousel-next-btn");
        if (el.contains (prev) && el.contains (next)) {
            prev.addEventListener ("click", () => {
                window.clearInterval (this.autoplayEffect);
                slider_prev (el);
            }, false);

            next.addEventListener ("click", () => {
                window.clearInterval (this.autoplayEffect);
                slider_next (el);
            }, false);
        }
        if (el.contains (pagination_content)) {
            pagination ();
            let paginate = pagination_content.querySelectorAll (".item");
            Array.prototype.forEach.call (paginate, (el) => {
                el.addEventListener ("click", () => {
                    window.clearInterval (this.autoplayEffect);
                    let last_i = el.parentNode.lastChild.tabIndex,
                        i = el.tabIndex;
                    let ml_ = widths * i;
                    content.style.transform = "translate3d(-" + ml_ + "px,0px,0px)";
                }, false);
            });
        }
    };
    window.addEventListener ("resize", () => {
        d_widths = el.offsetWidth;
        console.log ("ekran değişti", d_widths);
        responsive_grid ();
    }, true);
    responsive_grid ();
    slider_direction (el);
    autoplay_ ();
    index_settings ();

    });

    return this;
};

carousel();