import React,{useEffect,useState} from 'react'
import Spinner from '../Component/Spinner'
import axios from 'axios'
export default function Home() {
  const [Category,setCategory] = useState([]);
  const [Product,setProduct] = useState([]);
  const [Loader,setLoader] =  useState(true);
 
  
  const fetchData = ()=>{
    axios.get('api/home').then((d)=>{
    const {category,product} = d.data.data;
      setCategory(category);
      setProduct(product.data);
  });
  }
  useEffect(()=>{
    fetchData();
    setLoader(false);
  },[]);
  return (
    <React.Fragment>
      {
        Loader &&  <Spinner />
      }
      {
        !Loader && <React.Fragment>
              <div className="container mt-3">
  <div className="row">
    {/* For Category and Information */}
    <div className="col-md-4">
      <div className="card">
        <div className="card-body">
          <ul className="list-group">
            <li className="list-group-item bg-dark text-white">
              Your Order List
            </li>
            <li className="list-group-item bg-danger text-white">
              Your Profile Info
            </li>
          </ul>{" "}
        </div>
      </div>
      <div className="card">
        <div className="card-body">
          <ul className="list-group">
            <li className="list-group-item bg-primary text-white">
              All Category
            </li>
            { Category.map((d)=>(
               <li className="list-group-item" key={d.slug}>
               {d.name}
               <span className="badge badge-primary float-right">{d.products_count}</span>
             </li>
            ))}
           
          </ul>
        </div>
      </div>
    </div>
    <div className="col-md-8">
      <div className="card">
        <div className="card-body">
          <div className="row">
            {/* Loop Product */}
          {
            Product.map((d)=>(
              <div className="col-md-4" key={d.slug}>
              <a href="product/`${d.slug}`"></a>
              <div className="card">
              <a href={`/product/${d.slug}`} >
                  <img
                    className="card-img-top"
                    src={d.image_url}
                    alt="image"
                  />{" "}
                </a>
                <div className="card-body">
                  <a href={`/product/${d.slug}`} 
                  >
                    <div className="row">
                      <div className="col-md-12">
                        <h4>{d.name}</h4>
                      </div>
                    </div>
                  </a>
                  <div className="row">
                    <a href="detail.html"> </a>
                    <div className="col-md-4">
                      <a href="detail.html"></a>
                      <a href="" className="badge badge-primary">
                        {d.sale_price}ks
                      </a>
                    </div>
                    <div className="col-md-4">
                      <a href="" className="badge badge-warning">
                        {d.brand.name}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            ))
            
          }
          </div>
          <div className="row">
            <div className="col-md-6 offset-3">
              <nav aria-label="Page navigation example">
                <ul className="pagination">
                  <li className="page-item">
                    <a className="page-link" href="#">
                      &lt;<previous></previous>
                    </a>
                  </li>
                  <li className="page-item">
                    <a className="page-link" href="#">
                      1
                    </a>
                  </li>
                  <li className="page-item">
                    <a className="page-link" href="#">
                      2
                    </a>
                  </li>
                  <li className="page-item">
                    <a className="page-link" href="#">
                      3
                    </a>
                  </li>
                  <li className="page-item">
                    <a className="page-link" href="#">
                      &gt;
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
        </React.Fragment>
      }
  

    </React.Fragment>
    
  )
}
