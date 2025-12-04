// =====================================================
// SIPADU - GPS & Geolocation Functions
// HTML5 Geolocation API Implementation
// =====================================================

class GPSHandler {
  constructor(options = {}) {
    this.latitudeInput = options.latitudeInput || document.getElementById("latitude")
    this.longitudeInput = options.longitudeInput || document.getElementById("longitude")
    this.button = options.button || document.getElementById("gps-button")
    this.statusElement = options.statusElement || document.getElementById("gps-status")
    this.mapPreview = options.mapPreview || document.getElementById("map-preview")

    this.options = {
      enableHighAccuracy: false,
      timeout: 1000,
      maximumAge: 0,
    }

    this.init()
  }

  init() {
    if (this.button) {
      this.button.addEventListener("click", () => this.getLocation())
    }
  }

  getLocation() {
    if (!navigator.geolocation) {
      this.showStatus("error", "Browser Anda tidak mendukung Geolocation")
      return
    }

    this.showStatus("loading", "Mengambil koordinat...")
    this.setButtonLoading(true)

    navigator.geolocation.getCurrentPosition(
      (position) => this.onSuccess(position),
      (error) => this.onError(error),
      this.options,
    )
  }

  onSuccess(position) {
    const { latitude, longitude, accuracy } = position.coords

    if (this.latitudeInput) {
      this.latitudeInput.value = latitude.toFixed(8)
    }

    if (this.longitudeInput) {
      this.longitudeInput.value = longitude.toFixed(8)
    }

    this.showStatus("success", `Koordinat berhasil diambil (Akurasi: ${accuracy.toFixed(0)}m)`)
    this.setButtonLoading(false)
    this.updateMapPreview(latitude, longitude)

    // Trigger change event
    if (this.latitudeInput) {
      this.latitudeInput.dispatchEvent(new Event("change"))
    }
    if (this.longitudeInput) {
      this.longitudeInput.dispatchEvent(new Event("change"))
    }
  }

  onError(error) {
    let message = ""

    switch (error.code) {
      case error.PERMISSION_DENIED:
        message = "Izin lokasi ditolak. Silakan aktifkan izin lokasi di browser Anda."
        break
      case error.POSITION_UNAVAILABLE:
        message = "Informasi lokasi tidak tersedia. Pastikan GPS aktif."
        break
      case error.TIMEOUT:
        message = "Waktu pengambilan lokasi habis. Silakan coba lagi."
        break
      default:
        message = "Terjadi kesalahan saat mengambil lokasi."
    }

    this.showStatus("error", message)
    this.setButtonLoading(false)
  }

  showStatus(type, message) {
    if (!this.statusElement) return

    const colors = {
      loading: "var(--info)",
      success: "var(--success)",
      error: "var(--danger)",
    }

    const icons = {
      loading: "⏳",
      success: "✓",
      error: "✕",
    }

    this.statusElement.innerHTML = `
            <span style="color: ${colors[type]}">
                ${icons[type]} ${message}
            </span>
        `

    // Auto hide success message after 3 seconds
    if (type === "success") {
      setTimeout(() => {
        this.statusElement.innerHTML = ""
      }, 3000)
    }
  }

  setButtonLoading(loading) {
    if (!this.button) return

    if (loading) {
      this.button.disabled = true
      this.button.innerHTML = `
                <svg class="spinner" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
                    <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/>
                </svg>
                Mengambil Lokasi...
            `
    } else {
      this.button.disabled = false
      this.button.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 2v3M12 19v3M2 12h3M19 12h3"/>
                </svg>
                Ambil Koordinat GPS
            `
    }
  }

  updateMapPreview(lat, lng) {
    if (!this.mapPreview) return

    // Using OpenStreetMap static image
    const zoom = 15
    this.mapPreview.innerHTML = `
            <div style="position: relative; height: 200px; background: var(--gray-200); border-radius: var(--radius); overflow: hidden;">
                <iframe 
                    width="100%" 
                    height="200" 
                    frameborder="0" 
                    scrolling="no" 
                    src="https://www.openstreetmap.org/export/embed.html?bbox=${lng - 0.01},${lat - 0.01},${lng + 0.01},${lat + 0.01}&layer=mapnik&marker=${lat},${lng}"
                    style="border-radius: var(--radius);">
                </iframe>
                <div style="position: absolute; bottom: 10px; left: 10px; right: 10px; background: rgba(255,255,255,0.9); padding: 8px 12px; border-radius: var(--radius); font-size: 0.875rem;">
                    <strong>Koordinat:</strong> ${lat.toFixed(6)}, ${lng.toFixed(6)}
                    <a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank" style="float: right; color: var(--primary);">
                        Buka di Google Maps →
                    </a>
                </div>
            </div>
        `
  }

  setCoordinates(lat, lng) {
    if (this.latitudeInput) {
      this.latitudeInput.value = lat
    }
    if (this.longitudeInput) {
      this.longitudeInput.value = lng
    }
    this.updateMapPreview(Number.parseFloat(lat), Number.parseFloat(lng))
  }
}

// Initialize GPS on page load
document.addEventListener("DOMContentLoaded", () => {
  // Auto-init if elements exist
  const gpsButton = document.getElementById("gps-button")
  if (gpsButton) {
    window.gpsHandler = new GPSHandler()
  }
})

// Global function to open Google Maps
function openGoogleMaps(lat, lng) {
  window.open(`https://www.google.com/maps?q=${lat},${lng}`, "_blank")
}

// Global function to get directions
function getDirections(lat, lng) {
  window.open(`https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`, "_blank")
}
