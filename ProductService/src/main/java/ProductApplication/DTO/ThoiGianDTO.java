package ProductApplication.DTO;


public class ThoiGianDTO {
    
	private String ThoiDiemBatDau;
    private String ThoiDiemKetThuc;
    
	@Override
	public String toString() {
		return "ThoiGianDTO [ThoiDiemBatDau=" + ThoiDiemBatDau + ", ThoiDiemKetThuc=" + ThoiDiemKetThuc + "]";
	}

	public String getThoiDiemBatDau() {
		return ThoiDiemBatDau;
	}

	public void setThoiDiemBatDau(String thoiDiemBatDau) {
		ThoiDiemBatDau = thoiDiemBatDau;
	}

	public String getThoiDiemKetThuc() {
		return ThoiDiemKetThuc;
	}

	public void setThoiDiemKetThuc(String thoiDiemKetThuc) {
		ThoiDiemKetThuc = thoiDiemKetThuc;
	}

    
}
