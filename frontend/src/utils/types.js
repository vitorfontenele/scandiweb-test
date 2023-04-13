const types = {
    "book": {
        attrs: [
            ["weight", "Weight (KG)", "number"]
        ],
        description: "Please provide product weight (kg)",
        formatAttrs(specialAttributes){
            const { weight } = specialAttributes;
            return `Weight: ${weight}KG`;
        }
    },
    "dvd": {
        attrs: [
            ["size", "Size (MB)", "number"]
        ],
        description: "Please provide product size (MB)",
        formatAttrs(specialAttributes){
            const { size } = specialAttributes;
            return `Size: ${size} MB`;
        }
    },
    "furniture": {
        attrs: [
            ["height", "Height (CM)", "number"],
            ["width", "Width (CM)", "number"],
            ["length", "Length (CM)", "number"]
        ],
        description: "Please provide product dimensions (HxWxL) (cm)",
        formatAttrs(specialAttributes){
            const { height, width, length } = specialAttributes;
            return `Dimension: ${height}x${width}x${length}`;
        }
    }
}

export default types;