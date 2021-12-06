
/**
 * Unwrap
 */
function unWrap(el) {

    // get the element's parent node
    let parent = el.parentNode;
    
    // move all children out of the element
    while (el.firstChild) parent.insertBefore(el.firstChild, el);
    
    // remove the empty element
    parent.removeChild(el);
}


/**
 * Wrap an element
 * 
 * @link https://plainjs.com/javascript/manipulation/wrap-an-html-structure-around-an-element-28/
 */
function wrap(el, wrapper) {
    el.parentNode.insertBefore(wrapper, el);
    wrapper.appendChild(el);
}

// /**
//  * Wrap inner
//  */
// function wrapInner(el, wrapper) {
//     el.insertBefore(wrapper, el);
//     wrapper.appendChild(el);
// }

/**
 * Wrap wrapper around nodes
 * 
 * Just pass a collection of nodes, and a wrapper element
 * 
 * @link https://stackoverflow.com/a/41391872/9055081
 */
function wrapAll(nodes, wrapper) {
    // Cache the current parent and previous sibling of the first node.
    var parent = nodes[0].parentNode;
    var previousSibling = nodes[0].previousSibling;

    // Place each node in wrapper.
    //  - If nodes is an array, we must increment the index we grab from 
    //    after each loop.
    //  - If nodes is a NodeList, each node is automatically removed from 
    //    the NodeList when it is removed from its parent with appendChild.
    for (var i = 0; nodes.length - i; wrapper.firstChild === nodes[0] && i++) {
        wrapper.appendChild(nodes[i]);
    }

    // Place the wrapper just after the cached previousSibling,
    // or if that is null, just before the first child.
    var nextSibling = previousSibling ? previousSibling.nextSibling : parent.firstChild;
    parent.insertBefore(wrapper, nextSibling);

    return wrapper;
}