import "./style.css";
import useForm from "../../hooks/useForm";
import { Fragment, useState } from "react";
import { useNavigate } from "react-router-dom";
import { goToHomePage } from "../../routes/coordinator";
import types from "../../utils/types";
import axios from "axios";
import { BASE_URL } from "../../constants/urls";
import LoadingModal from "../../components/LoadingModal/LoadingModal";
import Footer from "../../components/Footer/Footer";
import Header from "../../components/Header/Header";

const AddProductPage = () => {
    const [isLoading, setIsLoading] = useState(false);
    const [form, onChange] = useForm({sku: "", name: "", price: "", type: "", weight: "", size: "", length: "", height: "", width: ""});
    const [errorAttrs, setErrorAttrs] = useState([]);
    const [backendErr, setBackendErr] = useState("");

    const navigate = useNavigate();

    const attrs = [
        ["sku", "SKU", "text"],
        ["name", "Name", "text"],
        ["price", "Price ($)", "number"],
    ]; // [[input id, label text, input type]]

    const getSpecialAttrData = () => {
        const { attrs: specialAttrs = [], description: productDescription = "" } = types[form.type] || {};

        return { specialAttrs, productDescription };
    }

    const saveProduct = async () => {
        try {
            let errorAttrMonitor = [];
            let body = {...form};
            const { specialAttrs } = getSpecialAttrData();
            const allAttrs = [...attrs, ["type", "Type", "text"], ...specialAttrs];

            for (let i = 0; i < allAttrs.length; i++){
                if (form[allAttrs[i][0]] === ""){
                    errorAttrMonitor.push(allAttrs[i][0]);
                } else {
                    if (allAttrs[i][2] === "number"){
                        const parsedParam = parseFloat(body[allAttrs[i][0]]);
                        body[allAttrs[i][0]] = parsedParam;
                    }
                }
            }

            setErrorAttrs([...errorAttrMonitor]);
            if (errorAttrMonitor.length > 0){return};

            setIsLoading(true);
            await axios.post(BASE_URL + '/product', body);
            setIsLoading(false);

            goToHomePage(navigate);
            
        } catch (error) {
            console.log(error);
            setIsLoading(false);
            console.error(error?.response?.data);
            if (error?.response?.data){
                setBackendErr(error.response.data.error);
            }
        }
    }

    return (
        <div className="container">
            <Header 
                headerTitle={"Product Add"}
                firstButtonAction={() => saveProduct()}
                firstButtonText={"Save"}
                secondButtonAction={() => goToHomePage(navigate)}
                secondButtonText={"Cancel"}
            />
            <main id="add-product-main">
                <form id="product_form">
                    <div className="inputs-container">
                        {attrs.map((attr, i) => {
                            return (
                                <Fragment key={i}>
                                    <label htmlFor={attr[0]}>{attr[1]}</label>
                                    <input 
                                        className="input"
                                        type={attr[2]}
                                        name={attr[0]}
                                        id={attr[0]}
                                        value={form[attr[0]]}
                                        onChange={onChange}
                                    />
                                    <p className={`submit-warning ${errorAttrs.includes(attr[0]) ? 'visible' : 'hidden'}`}>{`Please submit ${attr[0]}`}</p>
                                </Fragment>
                            )
                        })}
                    </div>
                    <div id="select-container">
                        <label htmlFor="productType">Type Switcher</label>
                        <select 
                            className="input" 
                            name="type" 
                            id="productType" 
                            value={form.type} 
                            onChange={onChange}
                        >
                            <option value="">-</option>
                            <option id="Book" value="book">Book</option>
                            <option id="DVD" value="dvd">DVD</option>
                            <option id="Furniture" value="furniture">Furniture</option>
                        </select>
                        <p id="submit-warning-select" className={`submit-warning ${errorAttrs.includes("type") ? 'visible' : 'hidden'}`}>Please submit type</p>
                    </div>
                    <div id="special-inputs-container" className={form.type === "" ? "hidden" : "visible"}>
                        <div className={"inputs-container"}>
                            {getSpecialAttrData().specialAttrs.map((attr, i) => {
                                return (
                                    <Fragment key={i}>
                                        <label htmlFor={attr[0]}>{attr[1]}</label>
                                        <input 
                                            className="input"
                                            type={attr[2]}
                                            name={attr[0]}
                                            id={attr[0]}
                                            value={form[attr[0]]}
                                            onChange={onChange}
                                        />
                                        <p className={`submit-warning ${errorAttrs.includes(attr[0]) ? 'visible' : 'hidden'}`}>{`Please submit ${attr[0]}`}</p>
                                    </Fragment>               
                                )
                            })}
                        </div>
                        <p id="product-description">{getSpecialAttrData().productDescription}</p>
                    </div>
                </form>
                <div id="back-error-container" className={backendErr ? 'visible' : 'hidden'}>
                    <p id="back-error">*{backendErr}</p>
                </div>
            </main>
            <Footer />
            {isLoading && <LoadingModal />}
        </div>
    )
}

export default AddProductPage;