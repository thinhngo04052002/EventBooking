package ProductApplication.repository;

import java.util.List;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.data.mongodb.repository.Query;

import ProductApplication.model.LoaiVe;
import ProductApplication.model.SuatDien;
@SpringBootApplication
public interface SuatDienRepository extends MongoRepository<SuatDien, String> {
	SuatDien findByIDSuKienAndIDDoiTac(Integer IDSuKien,Integer IDDoiTac);
	@Query("{ 'SuatDien.SoThuTu' : ?0 }")
	List<LoaiVe> getLoaiVeByIDSuatDienAndIDSuKienAndIDDoiTac(Integer SoThuTu, Integer IDSuKien, Integer IDDoiTac);
}
