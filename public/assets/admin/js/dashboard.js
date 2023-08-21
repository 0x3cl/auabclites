
import { site_visitor_graph,
        site_referrersocmed_graph,
        site_referrersothers_graph
} from "./components/graph.js";

$(document).ready(function() {
    
    // SITE VISITOR GRAPH

    site_visitor_graph();
    site_referrersocmed_graph();
    site_referrersothers_graph();
});