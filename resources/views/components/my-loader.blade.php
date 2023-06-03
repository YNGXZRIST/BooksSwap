<div class="my-loader">
    <div class="loader-spinner"></div>
    <div class="loader-message">{{ $message }}</div>
</div>

<style>
    .my-loader {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(255, 255, 255);
        z-index: 9999;
    }

    .loader-spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
    }

    .loader-message {
        font-size: 24px;
        color: #000000;
        margin-top: 20px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>
