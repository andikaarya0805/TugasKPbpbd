setInterval(() => {
    fetch("../api_statistik_bencana.php")
        .then(res => res.json())
        .then(data => {
            document.getElementById("bencana-banjir").innerText = data.Banjir ?? 0;
            document.getElementById("bencana-longsor").innerText = data["Tanah Longsor"] ?? 0;
            document.getElementById("bencana-kebakaran").innerText = data.Kebakaran ?? 0;
            document.getElementById("bencana-gempa").innerText = data["Gempa Bumi"] ?? 0;
            document.getElementById("bencana-lainnya").innerText = data.Lainnya ?? 0;
        });
}, 2000);
