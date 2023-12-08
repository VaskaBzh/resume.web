<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Semibold.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Semibold.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Medium.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Medium.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Regular.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Regular.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Light.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/SF-Pro-Display-Light.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/Ubuntu-Regular.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/Ubuntu-Regular.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/Ubuntu-Medium.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/Ubuntu-Medium.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/Ubuntu-Light.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/Ubuntu-Light.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/AmpleSoftPro-Bold.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/AmpleSoftPro-Bold.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/AmpleSoftPro-Medium.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/AmpleSoftPro-Medium.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/AmpleSoftPro-Regular.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/AmpleSoftPro-Regular.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-Regular.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-Regular.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-Bold.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-Bold.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-SemiBold.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-SemiBold.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/Unbounded-Regular.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/Unbounded-Regular.woff") }}" as="font" type="font/woff" crossorigin>

<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-SemiBold.woff2") }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset("fonts/NunitoSans_10pt-SemiBold.woff") }}" as="font" type="font/woff" crossorigin>

<style>

    @font-face {
        font-family: SFPro;
        font-display: swap;
        src: url({{ asset("fonts/SF-Pro-Display-Semibold.woff2") }}) format("woff2"),
        url({{ asset("fonts/SF-Pro-Display-Semibold.woff") }}) format("woff");
        font-weight: 600;
        font-style: normal;
    }
    @font-face {
        font-family: SFPro;
        font-display: swap;
        src: url({{ asset("fonts/SF-Pro-Display-Medium.woff2") }}) format("woff2"),
        url({{ asset("fonts/SF-Pro-Display-Medium.woff") }}) format("woff");
        font-weight: 500;
        font-style: normal;
    }
    @font-face {
        font-family: SFPro;
        font-display: swap;
        src: url({{ asset("fonts/SF-Pro-Display-Regular.woff2") }}) format("woff2"),
        url({{ asset("fonts/SF-Pro-Display-Regular.woff") }}) format("woff");
        font-weight: 400;
        font-style: normal;
    }
    @font-face {
        font-family: SFPro;
        font-display: swap;
        src: url({{ asset("fonts/SF-Pro-Display-Light.woff2") }}) format("woff2"),
        url({{ asset("fonts/SF-Pro-Display-Light.woff") }}) format("woff");
        font-weight: 300;
        font-style: normal;
    }
    @font-face {
        font-family: Ubuntu;
        font-display: swap;
        src: url({{ asset("fonts/Ubuntu-Regular.woff2") }}) format("woff2"),
        url({{ asset("fonts/Ubuntu-Regular.woff") }}) format("woff");
        font-weight: 400;
        font-style: normal;
    }
    @font-face {
        font-family: Ubuntu;
        font-display: swap;
        src: url({{ asset("fonts/Ubuntu-Medium.woff2") }}) format("woff2"),
        url({{ asset("fonts/Ubuntu-Medium.woff") }}) format("woff");
        font-weight: 500;
        font-style: normal;
    }
    @font-face {
        font-family: Ubuntu;
        font-display: swap;
        src: url({{ asset("fonts/Ubuntu-Light.woff2") }}) format("woff2"),
        url({{ asset("fonts/Ubuntu-Light.woff") }}) format("woff");
        font-weight: 300;
        font-style: normal;
    }
    @font-face {
        font-family: AmpleSoftPro;
        font-display: swap;
        src: url({{ asset("fonts/AmpleSoftPro-Bold.woff2") }}) format("woff2"),
        url({{ asset("fonts/AmpleSoftPro-Bold.woff") }}) format("woff");
        font-weight: 700;
        font-style: normal;
    }
    @font-face {
        font-family: AmpleSoftPro;
        font-display: swap;
        src: url({{ asset("fonts/AmpleSoftPro-Medium.woff2") }}) format("woff2"),
        url({{ asset("fonts/AmpleSoftPro-Medium.woff") }}) format("woff");
        font-weight: 500;
        font-style: normal;
    }
    @font-face {
        font-family: AmpleSoftPro;
        font-display: swap;
        src: url({{ asset("fonts/AmpleSoftPro-Regular.woff2") }}) format("woff2"),
        url({{ asset("fonts/AmpleSoftPro-Regular.woff") }}) format("woff");
        font-weight: 400;
        font-style: normal;
    }
    @font-face {
        font-family: NunitoSans;
        font-display: swap;
        src: url({{ asset("fonts/NunitoSans_10pt-Regular.woff2") }}) format("woff2"),
        url({{ asset("fonts/NunitoSans_10pt-Regular.woff") }}) format("woff");
        font-weight: 400;
        font-style: normal;
    }
    @font-face {
        font-family: NunitoSans;
        font-display: swap;
        src: url({{ asset("fonts/NunitoSans_10pt-Bold.woff2") }}) format("woff2"),
        url({{ asset("fonts/NunitoSans_10pt-Bold.woff") }}) format("woff");
        font-weight: 700;
        font-style: normal;
    }
    @font-face {
        font-family: NunitoSans;
        font-display: swap;
        src: url({{ asset("fonts/NunitoSans_10pt-SemiBold.woff2") }}) format("woff2"),
        url({{ asset("fonts/NunitoSans_10pt-SemiBold.woff") }}) format("woff");
        font-weight: 600;
        font-style: normal;
    }
    @font-face {
        font-family: Unbounded;
        font-display: swap;
        src: url({{ asset("fonts/Unbounded-Regular.woff2") }}) format("woff2"),
        url({{ asset("fonts/Unbounded-Regular.woff") }}) format("woff");
        font-weight: 400;
        font-style: normal;
    }
    @font-face {
        font-family: NunitoSans;
        font-display: swap;
        src: url({{ asset("fonts/NunitoSans_10pt-SemiBold.woff2") }}) format("woff2"),
        url({{ asset("fonts/NunitoSans_10pt-SemiBold.woff") }}) format("woff");
        font-weight: 600;
        font-style: normal;
    }
</style>
