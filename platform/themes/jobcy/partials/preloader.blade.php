<style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #fff;
        z-index: 99999;
        transition: all 0.5s ease;
        visibility: visible;
        opacity: 1;
    }

    #preloader #status {
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    #status {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(118, 109, 244, 0.15);
    }

    #status ul {
        display: flex;
    }

    #status ul li {
        list-style: none;
        height: 20px;
        width: 20px;
        background-color: #766df4;
        margin: 0 4px;
        border-radius: 50%;
        -webkit-animation: bounce 1s linear infinite;
        animation: bounce 1s linear infinite;
    }

    #status ul li:nth-child(1) {
        -webkit-animation-delay: 0.2s;
        animation-delay: 0.2s;
        background-color: #1d10d2;
    }

    #status ul li:nth-child(2) {
        -webkit-animation-delay: 0.6s;
        animation-delay: 0.6s;
        background-color: #2012e9;
    }

    #status ul li:nth-child(3) {
        -webkit-animation-delay: 0.1s;
        animation-delay: 0.1s;
        background-color: #3326ef;
    }

    #status ul li:nth-child(4) {
        -webkit-animation-delay: 0.8s;
        animation-delay: 0.8s;
        background-color: #493ef0;
    }

    #status ul li:nth-child(5) {
        -webkit-animation-delay: 0.5s;
        animation-delay: 0.5s;
        background-color: #6055f2;
    }

    #status ul li:nth-child(6) {
        -webkit-animation-delay: 0.1s;
        animation-delay: 0.1s;
        background-color: #766df4;
    }

    @-webkit-keyframes bounce {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-40px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    @keyframes bounce {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-40px);
        }
        100% {
            transform: translateY(0px);
        }
    }
</style>
<div id="preloader">
    <div id="status">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
