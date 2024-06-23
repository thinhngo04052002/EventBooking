package ProductApplication.DTO;

import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class DiaDiemDTO {
    private String QuocGia;
    private String ThanhPho;
    private String NoiToChuc;

    public DiaDiemDTO() {
		super();
		// TODO Auto-generated constructor stub
	}

	public DiaDiemDTO(String quocGia, String thanhPho, String noiToChuc) {
        this.QuocGia = quocGia;
        this.ThanhPho = thanhPho;
        this.NoiToChuc = noiToChuc;
    }

    public String getQuocGia() {
        return QuocGia;
    }

    public void setQuocGia(String quocGia) {
        this.QuocGia = quocGia;
    }

    public String getThanhPho() {
        return ThanhPho;
    }

    public void setThanhPho(String thanhPho) {
        this.ThanhPho = thanhPho;
    }

    public String getNoiToChuc() {
        return NoiToChuc;
    }

    public void setNoiToChuc(String noiToChuc) {
        this.NoiToChuc = noiToChuc;
    }

	@Override
	public String toString() {
		return "DiaDiemDTO [QuocGia=" + QuocGia + ", ThanhPho=" + ThanhPho + ", NoiToChuc=" + NoiToChuc + "]";
	}
    
}
