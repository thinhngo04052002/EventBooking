package ProductApplication.repository;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.mongodb.repository.MongoRepository;

import ProductApplication.model.VeDaMua;
@SpringBootApplication
public interface VeDaMuaRepository extends MongoRepository<VeDaMua, String> {
	VeDaMua findByIDNguoiDung(Integer IDNguoiDung);
}
