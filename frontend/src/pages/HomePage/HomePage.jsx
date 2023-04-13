import axios from "axios";
import "./style.css";
import { useNavigate } from "react-router-dom";
import { BASE_URL } from "../../constants/urls";
import { goToAddProductPage} from "../../routes/coordinator";
import { useState, useEffect } from "react";
import ProductBox from "../../components/ProductBox/ProductBox";
import LoadingModal from "../../components/LoadingModal/LoadingModal";
import Footer from "../../components/Footer/Footer";
import Header from "../../components/Header/Header";

const HomePage = () => {
    const [products, setProducts] = useState([]);
    const [checkboxes, setCheckboxes] = useState([false]);
    const [isLoading, setIsLoading] = useState(false);
    const [deleteWarning, setDeleteWarning] = useState(false);

    const navigate = useNavigate();

    useEffect(() => {
        fetchProducts();
    }, []);

    useEffect(() => {
        setCheckboxes(Array(products.length).fill(false));
    }, [products]);

    const selectedInds = checkboxes
        .map((item, index) => item? index : null)
        .filter(item => item !== null);

    const fetchProducts = async () => {
        setIsLoading(true);
        try {
            const responseProducts = await axios.get(BASE_URL + "/product");
            setProducts(responseProducts.data);
            setIsLoading(false);           
        } catch (error) {
            setIsLoading(false);
            console.error(error?.response?.data);
        }
    }

    const deleteProducts = async () => {
        try {
            const skusToDelete = selectedInds.map(ind => products[ind].sku);
            if (skusToDelete.length < 1){
                setDeleteWarning(true);
                return;
            }
            setIsLoading(true);
            const body = {skus: skusToDelete};
            await axios.post(BASE_URL + "/product/deletemany", body);
            setDeleteWarning(false);
            fetchProducts();
        } catch (error) {
            setIsLoading(false);
            console.error(error?.response.data);
        }
    }

    const handleCheckbox = (index) => {
        const updatedCheckboxes = checkboxes.map((item, i) => {
            return index === i ? !item : item;
        });

        setCheckboxes(updatedCheckboxes);
    }

    return (
        <div className="container">
            <Header
                headerTitle={"Product List"}
                firstButtonAction={() => goToAddProductPage(navigate)}
                firstButtonText={"ADD"}
                secondButtonAction={() => deleteProducts()}
                secondButtonText={"MASS DELETE"}
            />
            <main id="home-main">
                {deleteWarning && <p id="delete-warning">*To delete select at least one product</p>}
                <div id="home-main-content">
                    {products.map((product, index) => {
                        return (
                            <ProductBox
                                product={product}
                                index={index}
                                checked={checkboxes[index]}
                                handleCheckbox={handleCheckbox}
                                key={index}
                            />
                        );
                    })}
                </div>
            </main>
            <Footer />
            {isLoading && <LoadingModal />}
        </div>
    )
}

export default HomePage;