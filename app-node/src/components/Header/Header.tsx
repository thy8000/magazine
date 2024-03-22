import { useQuery, gql } from "@apollo/client";
import Image  from 'next/image';

export default function Header() {
    const { data } = useQuery(Header.query);

    const customLogo = data?.customLogo ?? [];

    return (
        <header className="flex bg-header">
            <div>
                { customLogo.url !== null &&(
                    <Image
                        src={customLogo.url}
                        alt={customLogo.description}
                        width={customLogo.width}
                        height={customLogo.height}
                    />
                )}        
            </div>

            <div></div>

            <div></div>

        </header>
    );
}

Header.query = gql`
    {
    	customLogo {
		    url
		    description
		    width
            height
	    }
    }
`;