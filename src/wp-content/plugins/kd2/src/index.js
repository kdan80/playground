wp.blocks.registerBlockType('ourplugin/are-you-paying-attention', {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        skyColor: { type: "string"},
        grassColor: { type: "string"},
    },
    edit: function(props) {

        const updateSkyColor = (e) => {
            props.setAttributes({
                skyColor: e.target.value
            })
        }

        const updateGrassColor = (e) => {
            props.setAttributes({
                grassColor: e.target.value
            })
        }

        return (
            <div>
                <input type="text" placeholder="sky color" onChange={updateSkyColor} value={props.attributes.skyColor} />
                <input type="text" placeholder="grass color" onChange={updateGrassColor} value={props.attributes.grassColor} />
            </div>
        )
    },
    save: function(props) {
        return null;
    }
})