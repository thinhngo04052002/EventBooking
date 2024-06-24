package ProductApplication.repository;

import java.util.List;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.data.mongodb.repository.Query;

import ProductApplication.model.DiaDiem;
import ProductApplication.model.SuKien;
@SpringBootApplication
public interface SuKienRepository extends MongoRepository<SuKien, String> {
	SuKien findByIdSuKienAndIdDoiTac(Integer IDSuKien,Integer IdDoiTac);
	List<SuKien> findByTheLoai(String TheLoai);
	List<SuKien> findByIdDoiTac(Integer IDSuKien);
	@Query("{ 'TenSuKien' : { $regex: ?0, $options: 'i' } }")
	List<SuKien> findByTenSuKien(String TenSuKien);
	long countByIdSuKien(Integer idSuKien);
	List<SuKien> findByDiaDiem(DiaDiem diaDiem);
	List<SuKien> findByAnhNenSuKien(String anhNenSuKien);
	List<SuKien> findByThanhToan(String ThanhToan);
	@Query("{ 'DiaDiem.QuocGia' : ?0 }")
    List<SuKien> findByQuocGia(String quocGia);
	
	@Query("{ 'DiaDiem.ThanhPho' : ?0 }")
    List<SuKien> findByThanhPho(String ThanhPho);
	
	@Query("{ 'DiaDiem.NoiToChuc' : { $regex: ?0, $options: 'i' } }")
    List<SuKien> findByNoiToChuc(String NoiToChuc);
	List<SuKien> findByTheLoaiContaining(String theLoai);
	@Query("{ 'TenSuKien' : { $regex: ?0, $options: 'i' }, 'DiaDiem.QuocGia' : ?1, 'DiaDiem.ThanhPho' : ?2, 'DiaDiem.NoiToChuc' : { $regex: ?3, $options: 'i' } }")
    List<SuKien> findByTenSuKienAndDiaDiem(String TenSuKien, String QuocGia, String ThanhPho, String NoiToChuc);
}
