package ProductApplication.repository;

import java.util.List;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.mongodb.repository.MongoRepository;

import ProductApplication.model.Ve;
@SpringBootApplication
public interface VeRepository extends MongoRepository<Ve, String> {
	List<Ve> findByIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiDung(Integer IDSuKien,Integer IDSuatDien,Integer IDDoiTac, String TrangThaiDung);
	List<Ve> findByIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(Integer IDSuKien,Integer IDSuatDien,Integer IDDoiTac, String trangThaiBan);
	List<Ve> findByIDLoaiVeAndIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(Integer IDLoaiVe, Integer IDSuKien,Integer IDSuatDien,Integer IDDoiTac, String TrangThaiBan);
	Ve findByIDVe(Integer iDVe);
	Ve findByIDVeAndIDLoaiVeAndIDSuKien(Integer iDVe,Integer IDLoaiVe, Integer IDSuKien);
	Ve findByIDVeAndIDSuKienAndIDDoiTac(Integer iDVe, Integer IDSuKien,Integer IDDoiTac);
	List<Ve> findByIDLoaiVeAndIDSuKien(Integer IDLoaiVe, Integer IDSuKien);
	List<Ve> findByIDSuKien(Integer IDSuKien);
	List<Ve> findByIDSuKienAndIDSuatDienAndIDDoiTac(Integer IDSuKien,Integer IDSuatDien,Integer IDDoiTac);
	List<Ve> findByIDLoaiVeAndIDSuKienAndIDSuatDienAndIDDoiTac(Integer IDLoaiVe, Integer IDSuKien,Integer IDSuatDien,Integer IDDoiTac);
}
