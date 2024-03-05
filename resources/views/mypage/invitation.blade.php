<x-app-layout>
    <div class="py-6 sm:py-12 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl sm:text-2xl md:text-4xl font-bold text-red-700 text-center mb-4">招待キャンペーン</h2>
                    <p class="text-lg sm:text-xl md:text-2xl text-center mb-6">友達を招待して500円分のポイントをゲットしよう！</p>
                    <div class="bg-gray-100 rounded-lg p-6">
                        <p class="text-lg sm:text-xl md:text-xl font-bold mb-2">あなたの招待コード</p>
                        <div class="flex items-center justify-between" onclick="copyToClipboard()">
                            <p class="text-3xl sm:text-2xl md:text-3xl font-bold text-blue-500 mr-4"
                                id="invitationCode">{{ $invitationCode }}</p>
                            <p class="text-base sm:text-lg md:text-xl text-gray-400">タップしてコピー</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-2">使い方</h3>
                        <div class="mb-4">
                            <p><span class="font-bold text-lg sm:text-xl md:text-2xl">1. 招待コードを友達に送る</span><br>
                                <span
                                    class="text-gray-700 text-base sm:text-lg md:text-xl">友達に招待コードを送信してください。コードは登録時に必要となります。</span>
                            </p>
                        </div>
                        <div class="mb-4">
                            <p><span class="font-bold text-lg sm:text-xl md:text-2xl">2. 登録時に招待コードを使用</span><br>
                                <span
                                    class="text-gray-700 text-base sm:text-lg md:text-xl">友達が登録する際に、招待コードを入力するように依頼してください。<br>
                                    友達が招待コードを使って登録すると、両方に500ポイントが付与されます。</span>
                            </p>
                        </div>
                        <div>
                            <p><span class="font-bold text-lg sm:text-xl md:text-2xl">3. ポイントの利用</span><br>
                                <span
                                    class="text-gray-700 text-base sm:text-lg md:text-xl">ポイントは商品の購入時に利用できます。購入手続きの際にポイントを選択してください。</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="text-center">
            <button onclick="inviteOnLine()"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded mt-4">LINEで招待する</button>
        </div>
    </div>
</x-app-layout>

<script>
    function copyToClipboard() {
        const invitationCode = document.getElementById('invitationCode').innerText;
        navigator.clipboard.writeText(invitationCode).then(() => {
            alert('✔ コピーしました。');
        }).catch(err => {
            console.error('招待コードのコピーに失敗しました: ', err);
        });
    }

    function inviteOnLine() {
        const invitationCode = document.getElementById('invitationCode').innerText;
        const message =
            `coachtechフリマに登録しませんか？\nこちらの招待コードを入力すれば500ポイントもらえます!😊\n🎁 招待コード【 ${invitationCode.toUpperCase()} 】`;

        const lineShareURL =
            `https://social-plugins.line.me/lineit/share?url=&text=${encodeURIComponent(message).replace(/%0D%0A/g, '%0A')}`;

        window.open(lineShareURL, '_blank');
    }
</script>
