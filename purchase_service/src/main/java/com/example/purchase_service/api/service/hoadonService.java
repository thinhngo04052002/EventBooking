package com.example.purchase_service.api.service;

import java.math.BigDecimal;
import java.time.Duration;
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.Date;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.purchase_service.api.dto.HuyHoaDonDto;
import com.example.purchase_service.api.dto.addHoaDonDoiVeDto;
import com.example.purchase_service.api.dto.addHoaDonMuaVeDto;
import com.example.purchase_service.api.dto.addHoadonDto;
import com.example.purchase_service.api.model.hoadon;
import com.example.purchase_service.api.model.khuyenmai;
import com.example.purchase_service.api.repository.hoadonRepository;

@Service
public class hoadonService {
    @Autowired
    private hoadonRepository repo;

    private final khuyenmaiService khuyenMaiService;

    public hoadonService(khuyenmaiService khuyenMaiService) {
        this.khuyenMaiService = khuyenMaiService;
    }

    public List<hoadon> getAllhoadon() {
        return repo.findAll();
    }

    public hoadon gethoadonById(int id) {
        return repo.findById(id);
    }

    public hoadon createhoadon(addHoadonDto dto) {
        // Tạo một đối tượng hoadon mới
        hoadon hoadon = new hoadon();
        hoadon.setIDTaiKhoan(dto.getIDTaiKhoan());
        hoadon.setIDVe(dto.getIDVe());
        hoadon.setIDSuKien(dto.getIDSuKien());
        hoadon.setIDDoiTac(dto.getIDDoiTac());
        hoadon.setIDKhuyenMai(dto.getIDKhuyenMai());
        hoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
        hoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
        hoadon.setThanhTien(dto.getThanhTien());
        hoadon.setDaHuy(dto.getDaHuy());

        // Lưu sản phẩm mới vào cơ sở dữ liệu
        return repo.save(hoadon);
    }

    public hoadon CreateHoaDonMuaVe(addHoaDonMuaVeDto dto) {
        // Kiểm tra tình trạng bán của vé từ service Product
        // Đây là hard code
        boolean TrangThaiBan = true;
        if (TrangThaiBan == false) {
            throw new RuntimeException("Vé đã được mua bởi người dùng khác.");
        } else {
            // Lấy giá trị chiết khấu từ khuyến mãi
            khuyenmai khuyenMai = khuyenMaiService.getKhuyenMaiById(dto.getIDKhuyenMai());
            if (khuyenMai == null) {
                throw new RuntimeException("Không tồn tại khuyến mãi.");
            }
            int chietkhau = khuyenMai.getChietkhau();
            // Lấy giá vé từ service Product
            BigDecimal giaVe = new BigDecimal("500000");
            // Tính thành tiền từ giá vé gốc và chiết khấu
            BigDecimal thanhTien = giaVe
                    .multiply(BigDecimal.ONE.subtract(new BigDecimal(chietkhau).divide(new BigDecimal(100))));
            // Tạo một đối tượng hoadon mới
            hoadon hoadon = new hoadon();
            hoadon.setIDTaiKhoan(dto.getIDTaiKhoan());
            hoadon.setIDVe(dto.getIDVe());
            hoadon.setIDSuKien(dto.getIDSuKien());
            hoadon.setIDDoiTac(dto.getIDDoiTac());
            hoadon.setIDKhuyenMai(dto.getIDKhuyenMai());
            hoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
            hoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
            hoadon.setThanhTien(thanhTien);
            hoadon.setDaHuy(0);

            // Lưu sản phẩm mới vào cơ sở dữ liệu
            return repo.save(hoadon);
        }
    }

    public hoadon CreateHoaDonDoiVe(addHoaDonDoiVeDto dto) {
        // Lấy IDTaiKhoan từ IDNguoiDung, service user
        int IDTaiKhoan = dto.getIDNguoiDung();
        // Lấy giá vé mà khách hàng thực sự trả khi mua từ service purchase, vé đã mua
        BigDecimal giaBan = new BigDecimal("350000");
        // Lấy giá niêm yết vé cũ và vé mới từ service purchase
        BigDecimal giaVeCu = new BigDecimal("400000");
        BigDecimal giaVeMoi = new BigDecimal("300000");
        // Lấy khoảng chênh lệch tiền vé = số tiền phải trả thêm, đổi vé trừ thêm 20%
        // giá niêm yết vé cũ
        BigDecimal ThanhTien = giaVeMoi.subtract(giaBan.subtract(giaVeCu.multiply(new BigDecimal("0.8"))));
        // Tạo một đối tượng hoadon mới
        hoadon hoadon = new hoadon();
        hoadon.setIDTaiKhoan(IDTaiKhoan);
        hoadon.setIDVe(dto.getIDVeMoi());
        hoadon.setIDSuKien(dto.getIDSuKien());
        hoadon.setIDDoiTac(dto.getIDDoiTac());
        hoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
        hoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
        hoadon.setThanhTien(ThanhTien);
        hoadon.setDaHuy(0);
        // Lưu sản phẩm mới vào cơ sở dữ liệu
        return repo.save(hoadon);
    }

    public hoadon updatehoadon(int id, addHoadonDto dto) {
        hoadon updatehoadon = repo.findById(id);
        if (updatehoadon != null) {
            updatehoadon.setIDTaiKhoan(dto.getIDTaiKhoan());
            updatehoadon.setIDVe(dto.getIDVe());
            updatehoadon.setIDKhuyenMai(dto.getIDKhuyenMai());
            updatehoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
            updatehoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
            updatehoadon.setThanhTien(dto.getThanhTien());
            updatehoadon.setDaHuy(dto.getDaHuy());
            return repo.save(updatehoadon);
        } else {
            return null;
        }
    }

    public hoadon HuyHoaDon(HuyHoaDonDto dto) {
        Date ThoiDiemThanhToan = new Date();
        // Kiểm tra người dùng đủ điều kiện đổi hoặc hủy vé không
        boolean check = checkRemainingTime(dto.getIDNguoiDung(), dto.getIDVe(), dto.getIDSuKien(), dto.getIDDoiTac(),
                ThoiDiemThanhToan);
        if (check == true) {
            // Lấy IDTaiKhoan từ IDNguoiDung, service user
            int IDTaiKhoan = dto.getIDNguoiDung();
            hoadon updatehoadon = repo.findByIDTaiKhoanAndIDVe(IDTaiKhoan, dto.getIDVe());
            if (updatehoadon != null) {
                updatehoadon.setDaHuy(1);
                return repo.save(updatehoadon);
            } else {
                return null;
            }
        } else {
            throw new RuntimeException("Không thõa điều kiện về thời điểm đổi vé.");
        }
    }

    public boolean deletehoadon(int id) {
        if (repo.existsById(id)) {
            repo.deleteById(id);
            return true;
        } else {
            return false;
        }
    }

    public boolean checkRemainingTime(int IDNguoiDung, int IDVe, int IDSuKien, int IDDoiTac, Date ThoiDiemDoiHuyVe) {
        // Lấy ra thời điểm bắt đầu của sự kiện từ VeDaMua của service Product
        // Hardcode demo thời điểm
        LocalDate ThoiDiemBatDau = LocalDate.of(2024, 6, 22);
        // Chuyển đổi Date sang LocalDate
        LocalDate ThoiDiemDoiHuyVeLocal = ThoiDiemDoiHuyVe.toInstant().atZone(ZoneId.systemDefault()).toLocalDate();
        // Tính khoảng thời gian chênh lệch giữa thời điểm hiện tại và thời điểm bắt đầu
        // sự kiện
        Duration duration = Duration.between(ThoiDiemDoiHuyVeLocal.atStartOfDay(), ThoiDiemBatDau.atStartOfDay());
        long ThoiGianChenhLech = duration.toDays();
        // Nếu còn hơn 7 ngày mới đến lúc bắt đầu sự kiện thì được phép đổi hoặc hủy vé
        if (ThoiGianChenhLech < 7) {
            return false;
        }
        return true;
    }

}
