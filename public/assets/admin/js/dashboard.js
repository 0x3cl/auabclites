
import {
        site_overview,
        site_visitor_graph,
        site_referrer_graph,
} from "./components/graph.js";

$(document).ready(function() {
    
    // SITE VISITOR GRAPH

    if(window.location.pathname === '/admin/dashboard') {
        site_overview();
        site_visitor_graph();
        site_referrer_graph();
    }
    
});