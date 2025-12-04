// =====================================================
// SIPADU - CRUD + API Integration
// =====================================================

document.addEventListener("DOMContentLoaded", () => {
  initEvents();
  loadTableData();
});

// ============================
// CONFIG API
// ============================
const API_BASE = "/api/laporan"; // <-- ganti sesuai backend kamu

// ============================
// INIT EVENT
// ============================
function initEvents() {
  // Submit form CREATE
  const formCreate = document.getElementById("formCreate");
  if (formCreate) {
    formCreate.addEventListener("submit", (e) => {
      e.preventDefault();
      createData(new FormData(formCreate));
    });
  }

  // Submit form UPDATE
  const formUpdate = document.getElementById("formUpdate");
  if (formUpdate) {
    formUpdate.addEventListener("submit", (e) => {
      e.preventDefault();
      updateData(new FormData(formUpdate));
    });
  }
}

// ============================
// CREATE DATA
// ============================
async function createData(formData) {
  try {
    formData.append("kode_laporan", generateKodeLaporan());

    console.log("DEBUG — FormData yang dikirim:");
    for (let p of formData.entries()) {
      console.log(p[0], p[1]);
    }

    const res = await fetch(API_BASE, {
      method: "POST",
      body: formData
    });

    const result = await res.json();

    console.log("DEBUG — Respon API:", result);

    if (result.success) {
      showAlert("success", "Data berhasil ditambahkan");
      closeModal("modalCreate");
      loadTableData();
    } else {
      showAlert("danger", result.message || "Gagal menambahkan data");
    }
  } catch (err) {
    console.log("DEBUG — ERROR:", err);
  }
}

// ============================
// READ DATA
// ============================
async function loadTableData() {
  const tbody = document.querySelector("#tableData tbody");
  if (!tbody) return;

  tbody.innerHTML = "<tr><td colspan='10'>Loading...</td></tr>";

  try {
    const res = await fetch(API_BASE);
    const data = await res.json();

    tbody.innerHTML = "";

    data.forEach((row, i) => {
      tbody.innerHTML += `
        <tr>
          <td>${i + 1}</td>
          <td>${row.kode_laporan}</td>
          <td>${row.nama_pelapor}</td>
          <td>${row.lokasi}</td>
          <td>${row.jenis_bencana}</td>
          <td>${formatDate(row.tanggal)}</td>
          <td>${row.status}</td>
          <td class="no-export">
            <button onclick="openDetail('${row.id}')">Detail</button>
            <button onclick="editData('${row.id}')">Edit</button>
            <button onclick="deleteData('${row.id}')">Hapus</button>
          </td>
        </tr>
      `;
    });
  } catch (err) {
    tbody.innerHTML = "<tr><td colspan='10'>Gagal memuat data</td></tr>";
  }
}

// ============================
// GET DETAIL
// ============================
async function openDetail(id) {
  try {
    const res = await fetch(`${API_BASE}/${id}`);
    const data = await res.json();

    document.getElementById("detailKode").textContent = data.kode_laporan;
    document.getElementById("detailNama").textContent = data.nama_pelapor;
    document.getElementById("detailLokasi").textContent = data.lokasi;
    document.getElementById("detailJenis").textContent = data.jenis_bencana;
    document.getElementById("detailTanggal").textContent = formatDate(data.tanggal);
    document.getElementById("detailKeterangan").textContent = data.keterangan;

    openModal("modalDetail");
  } catch (err) {
    showAlert("danger", "Gagal memuat detail");
  }
}

// ============================
// EDIT (LOAD DATA KE FORM UPDATE)
// ============================
async function editData(id) {
  try {
    const res = await fetch(`${API_BASE}/${id}`);
    const data = await res.json();

    document.getElementById("u_id").value = data.id;
    document.getElementById("u_nama").value = data.nama_pelapor;
    document.getElementById("u_lokasi").value = data.lokasi;
    document.getElementById("u_jenis").value = data.jenis_bencana;
    document.getElementById("u_tanggal").value = data.tanggal;
    document.getElementById("u_keterangan").value = data.keterangan;

    openModal("modalUpdate");
  } catch (err) {
    showAlert("danger", "Gagal memuat data edit");
  }
}

// ============================
// UPDATE DATA
// ============================
async function updateData(formData) {
  try {
    const id = formData.get("id");

    const res = await fetch(`${API_BASE}/${id}`, {
      method: "PUT",
      body: formData,
    });

    const result = await res.json();

    if (result.success) {
      showAlert("success", "Data berhasil diperbarui");
      closeModal("modalUpdate");
      loadTableData();
    } else {
      showAlert("danger", result.message);
    }
  } catch (err) {
    showAlert("danger", "Gagal update data");
  }
}

// ============================
// DELETE DATA
// ============================
function deleteData(id) {
    if (!confirm("Yakin hapus laporan ini?")) return;

    fetch(`/kpfinal1/admin/laporan_hapus.php?id_laporan=${id}`)
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                alert(result.message);
                // reload table
                const row = document.querySelector(`#table-preview button[onclick="deleteData(${id})"]`).closest('tr');
                row.remove(); // hapus baris tanpa reload
            } else {
                alert(result.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Kesalahan server");
        });
}

// ============================
// GENERATE KODE
// ============================
function generateKodeLaporan() {
  const now = new Date();
  const year = now.getFullYear();
  const random = Math.floor(Math.random() * 10000)
    .toString()
    .padStart(4, "0");

  return `LAP-${year}-${random}`;
}

// ============================
// UTIL
// ============================
function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString("id-ID", {
    day: "2-digit",
    month: "long",
    year: "numeric",
  });
}

function showAlert(type, msg) {
  alert(msg);
}

let currentLaporan = {}; // Menyimpan data terakhir

function updateStatusRealtime(data) {
    if (!data || Object.keys(data).length === 0) return;

    const card = document.querySelector("#search-results .card");
    if (!card) return;

    // Update badge
    const badge = card.querySelector(".card-header .badge");
    if (badge && badge.textContent !== data.status) {
        badge.textContent = data.status;
        badge.className = `badge badge-${data.status.toLowerCase()}`;
    }

    // Update timeline
    const timelineContainer = card.querySelector(".timeline");
    if (!timelineContainer) return;

    const timelineHTML = (data.timeline || []).map(t => `
        <div class="timeline-item ${t.completed ? 'completed' : ''}">
            <div class="timeline-date">${t.waktu}</div>
            <div class="timeline-content">
                <strong>${t.status || '-'}</strong>
                <p>${t.keterangan || ''}</p>
            </div>
        </div>
    `).join("");

    timelineContainer.innerHTML = timelineHTML;

    let currentLaporan = {}; // global
let pollingInterval = null;

// update status realtime
function updateStatusRealtime(data) {
    if (!data || Object.keys(data).length === 0) return;

    const card = document.querySelector("#search-results .card");
    if (!card) return;

    // update badge
    const badge = card.querySelector(".card-header .badge");
    if (badge && badge.textContent !== data.status) {
        badge.textContent = data.status;
        badge.className = `badge badge-${data.status.toLowerCase()}`;
    }

    // update timeline
    const timelineContainer = card.querySelector(".timeline");
    if (timelineContainer) {
        timelineContainer.innerHTML = (data.timeline || []).map(t => `
            <div class="timeline-item ${t.completed ? 'completed' : ''}">
                <div class="timeline-date">${t.waktu}</div>
                <div class="timeline-content">
                    <strong>${t.status || '-'}</strong>
                    <p>${t.keterangan || ''}</p>
                </div>
            </div>
        `).join("");
    }

    currentLaporan = data; // simpan state terbaru
}

// polling untuk update otomatis
function startPolling(kode) {
    if (!kode) return;

    if (pollingInterval) clearInterval(pollingInterval);

    pollingInterval = setInterval(async () => {
        try {
            const res = await fetch(`cek_status_api.php?kode=${kode}`);
            const data = await res.json();
            if (data && Object.keys(data).length) {
                updateStatusRealtime(data);
            }
        } catch (err) {
            console.error("Gagal mengambil data:", err);
        }
    }, 3000); // tiap 3 detik
}

// submit form cari kode
document.getElementById("form-search-code").addEventListener("submit", async function(e) {
    e.preventDefault();
    const kode = document.getElementById("kode-laporan").value.trim();
    if (!kode) return;

    const res = await fetch(`cek_status_api.php?kode=${kode}`);
    const data = await res.json();

    if (data && Object.keys(data).length) {
        tampilkanHasil([data]); // render awal
        currentLaporan = data;
        startPolling(kode);      // mulai polling update otomatis
    } else {
        tampilkanKosong();
    }
});
}
