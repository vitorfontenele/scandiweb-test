import { BrowserRouter , Routes , Route } from "react-router-dom";
import HomePage from "../pages/HomePage/HomePage";
import AddProductPage from "../pages/AddProductPage/AddProductPage";

const Router = () => {
    return (
        <BrowserRouter>
            <Routes basename={'/'}>
                <Route path="/" element={<HomePage />} />
                <Route path="/addproduct" element={<AddProductPage />} />
            </Routes>
        </BrowserRouter>
    )
}

export default Router;