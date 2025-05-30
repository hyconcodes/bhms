<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-theme="light"
    data-sidebar-behaviour="fixed"
    data-navigation-color="inverted"
    data-is-fluid="true">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/theme.bundle.css') }}"
        id="stylesheetLTR" />
    <link
        rel="stylesheet"
        href="{{ asset('assets/css/theme.rtl.bundle.css') }}"
        id="stylesheetRTL" />

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        rel="preload"
        as="style"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" />
    <link
        rel="stylesheet"
        media="print"
        onload="this.onload=null;this.removeAttribute('media');"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" />

    <!-- no-JS fallback -->
    <noscript>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" />
    </noscript>

    <script>
        // Theme switcher

        let themeSwitcher = document.getElementById("themeSwitcher");

        const getPreferredTheme = () => {
            if (localStorage.getItem("theme") != null) {
                return localStorage.getItem("theme");
            }

            return document.documentElement.dataset.theme;
        };

        const setTheme = function(theme) {
            if (
                theme === "auto" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            ) {
                document.documentElement.dataset.theme = window.matchMedia(
                        "(prefers-color-scheme: dark)"
                    ).matches ?
                    "dark" :
                    "light";
            } else {
                document.documentElement.dataset.theme = theme;
            }

            localStorage.setItem("theme", theme);
        };

        const showActiveTheme = (theme) => {
            const activeBtn = document.querySelector(
                `[data-theme-value="${theme}"]`
            );

            document.querySelectorAll("[data-theme-value]").forEach((element) => {
                element.classList.remove("active");
            });

            activeBtn && activeBtn.classList.add("active");

            // Set button if demo mode is enabled
            document
                .querySelectorAll('[data-theme-control="theme"]')
                .forEach((element) => {
                    if (element.value == theme) {
                        element.checked = true;
                    }
                });
        };

        function reloadPage() {
            window.location = window.location.pathname;
        }

        setTheme(getPreferredTheme());

        if (typeof themeSwitcher != "undefined") {
            window
                .matchMedia("(prefers-color-scheme: dark)")
                .addEventListener("change", (e) => {
                    if (localStorage.getItem("theme") != null) {
                        if (localStorage.getItem("theme") == "auto") {
                            reloadPage();
                        }
                    }
                });

            window.addEventListener("load", () => {
                showActiveTheme(getPreferredTheme());

                document.querySelectorAll("[data-theme-value]").forEach((element) => {
                    element.addEventListener("click", () => {
                        const theme = element.getAttribute("data-theme-value");

                        localStorage.setItem("theme", theme);
                        reloadPage();
                    });
                });
            });
        }
    </script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/bhms/bouestilogo.png') }}" sizes="any" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Demo script -->
    <script>
        var themeConfig = {
            theme: JSON.parse('"light"'),
            isRTL: JSON.parse("false"),
            isFluid: JSON.parse("true"),
            sidebarBehaviour: JSON.parse('"fixed"'),
            navigationColor: JSON.parse('"inverted"'),
        };

        var isRTL = localStorage.getItem("isRTL") === "true",
            isFluid = localStorage.getItem("isFluid") === "true",
            theme = localStorage.getItem("theme"),
            sidebarSizing = localStorage.getItem("sidebarSizing"),
            linkLTR = document.getElementById("stylesheetLTR"),
            linkRTL = document.getElementById("stylesheetRTL"),
            html = document.documentElement;

        if (isRTL) {
            linkLTR.setAttribute("disabled", "");
            linkRTL.removeAttribute("disabled");
            html.setAttribute("dir", "rtl");
        } else {
            linkRTL.setAttribute("disabled", "");
            linkLTR.removeAttribute("disabled");
            html.removeAttribute("dir");
        }
    </script>
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <!-- Styles -->
</head>

<body>
    <script>
        let themeAttrs = document.documentElement.dataset;

        for (let attr in themeAttrs) {
            if (localStorage.getItem(attr) != null) {
                document.documentElement.dataset[attr] = localStorage.getItem(attr);

                if (theme === "auto") {
                    document.documentElement.dataset.theme = window.matchMedia(
                            "(prefers-color-scheme: dark)"
                        ).matches ?
                        "dark" :
                        "light";

                    window
                        .matchMedia("(prefers-color-scheme: dark)")
                        .addEventListener("change", (e) => {
                            e.matches ?
                                (document.documentElement.dataset.theme = "dark") :
                                (document.documentElement.dataset.theme = "light");
                        });
                }
            }
        }
    </script>
    @include('includes.sidebar')
    <main>
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
    </main>
    <script src="{{ asset('assets/js/theme.bundle.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> -->
</body>

</html>