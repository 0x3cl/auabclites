
import { site_visitor_graph,
        site_referrer_graph,
} from "./components/graph.js";

$(document).ready(function() {
    
    // SITE VISITOR GRAPH

    if(window.location.pathname === '/admin/dashboard') {
        site_visitor_graph();
        site_referrer_graph();
    }
});