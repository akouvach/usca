import React, { useState, useEffect } from "react";
import PropTypes from "prop-types";
import * as blogsApi from "../../api/blogsApi";

import BlogDetalle from "./blogDetalle";
import Loading from "../intermedio/loading";

// componentDidMount()
// componentDidUpdate()
// componentWillUnmount()

const Blog = ({ IdGrupo = 0 }) => {
  const [blog, blogSet] = useState([]);
  const [isLoading, isLoadingSet] = useState(false);

  useEffect(() => {
    isLoadingSet(true);
    console.log("idGrupo del blog:", IdGrupo);
    blogsApi.getLast(IdGrupo).then((data) => {
      console.log(data);
      blogSet(data);
      isLoadingSet(false);
    });

    return () => {
      console.log("estoy saliendo del blog");
    };
  }, []);

  return (
    <div className="w3-container">
      <Loading isLoading={isLoading} />
      <BlogDetalle Mensajes={blog} />
    </div>
  );
};

Blog.propTypes = {
  IdGrupo: PropTypes.any.isRequired,
};

export default Blog;
